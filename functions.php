<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'constants.php';

date_default_timezone_set('US/Eastern');

session_save_path(SESSION_SAVE_PATH);

session_start();

updateShiftChanges(getPdo());

function getPdo() {
    $host = DB_HOST;
    $dbname = DB_NAME;
    $username = DB_USERNAME;
    $password = DB_PASSWORD;

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    } catch(PDOException $e) {
        echo 'Error connecting to database: ' . $e->getMessage();
    }

    return null;
}

function insertAssociate($pdo, $id, $name) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO associates (id, name) ' . 
            'VALUES (:id, :name) ' . 
            'ON DUPLICATE KEY UPDATE ' . 
            '    name = :name'
        );

        $stmt->execute([
            ':id' => $id,
            ':name' => $name
        ]);

        return true;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return false;
}

function getAssociate($pdo, $id) {
    try {
        $stmt = $pdo->prepare(
            'SELECT * ' . 
            'FROM associates ' . 
            'WHERE id = :id'
        );

        $stmt->execute([
            ':id' => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function getAssociateLocations($pdo, $id) {
    try {
        $stmt = $pdo->prepare(
            'SELECT t1.*, t2.name location_name ' . 
            'FROM associate_locations t1 ' . 
            'JOIN locations t2 ' . 
            'ON t1.location_id = t2.id ' . 
            'WHERE associate_id = :associate_id ' . 
            'ORDER BY time DESC'
        );

        $stmt->execute([
            ':associate_id' => $id
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as &$row) {
            $stmt = $pdo->prepare(
                'SELECT * ' . 
                'FROM associate_locations ' . 
                'WHERE associate_id = :associate_id ' . 
                'AND time > :time ' . 
                'ORDER BY time ASC ' . 
                'LIMIT 1'
            );

            $stmt->execute([
                ':associate_id' => $row['associate_id'],
                ':time' => $row['time']
            ]);

            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            if($r) {
                $row['next_time'] = $r['time'];
            } else {
                $row['next_time'] = null;
            }
        }

        return $rows;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function moveAssociateToLocation($pdo, $associateId, $locationId) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO associate_locations (associate_id, location_id, `time`) ' . 
            'VALUES (:associate_id, :location_id, NOW())'
        );

        $stmt->execute([
            ':associate_id' => $associateId,
            ':location_id' => $locationId
        ]);

        return $pdo->lastInsertId();
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return false;
}

function addNote($pdo, $associateLocationId, $note) {
    try {
        $stmt = $pdo->prepare(
            'UPDATE associate_locations ' . 
            'SET note = :note ' . 
            'WHERE id = :id'
        );

        $stmt->execute([
            ':note' => $note,
            ':id' => $associateLocationId
        ]);

        return true;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return false;
}

function getAssociatesAtLocation($pdo, $locationId) {
    try {
        $stmt = $pdo->prepare(
            'SELECT t1.*, t3.name associate_name, t4.name location_name ' . 
            'FROM associate_locations t1 ' . 
            'JOIN (' .
            '    SELECT associate_id, MAX(time) max_time ' . 
            '    FROM associate_locations ' . 
            '    GROUP BY associate_id ' . 
            ') t2 ' . 
            'ON t1.associate_id = t2.associate_id AND ' . 
            't1.time = t2.max_time AND ' .
            't2.max_time > NOW() - INTERVAL 30 MINUTE AND ' .
            't1.location_id = :location_id ' . 
            'JOIN associates t3 ' . 
            'ON t1.associate_id = t3.id ' . 
            'JOIN locations t4 ' . 
            'ON t1.location_id = t4.id'
        );

        $stmt->execute([
            ':location_id' => $locationId
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $rows;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function getLocation($pdo, $id) {
    try {
        $stmt = $pdo->prepare(
            'SELECT * ' . 
            'FROM locations ' . 
            'WHERE id = :id'
        );

        $stmt->execute([
            ':id' => $id
        ]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function getLocationAssociateHistory($pdo, $locationId) {
    try {
        $stmt = $pdo->prepare(
            'SELECT t1.*, t2.name associate_name ' . 
            'FROM associate_locations t1 ' . 
            'JOIN associates t2 ' . 
            'ON t1.associate_id = t2.id ' . 
            'WHERE location_id = :location_id ' . 
            'ORDER BY time DESC'
        );

        $stmt->execute([
            ':location_id' => $locationId
        ]);

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as &$row) {
            $stmt = $pdo->prepare(
                'SELECT * ' . 
                'FROM associate_locations ' . 
                'WHERE associate_id = :associate_id ' . 
                'AND time > :time ' . 
                'ORDER BY time ASC ' . 
                'LIMIT 1'
            );

            $stmt->execute([
                ':associate_id' => $row['associate_id'],
                ':time' => $row['time']
            ]);

            $r = $stmt->fetch(PDO::FETCH_ASSOC);

            if($r) {
                $row['next_time'] = $r['time'];
            } else {
                $row['next_time'] = null;
            }
        }

        return $rows;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function getLocations($pdo) {
    try {
        $stmt = $pdo->prepare(
            'SELECT * ' . 
            'FROM locations ' . 
            'ORDER BY name ASC'
        );

        $stmt->execute();

        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach($rows as &$row) {
            $row['associates'] = getAssociatesAtLocation($pdo, $row['id']);
        }

        return $rows;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function insertLocations($pdo, $locations) {
    try {
        $stmt = $pdo->prepare(
            'INSERT INTO locations (id, name) ' . 
            'VALUES (:id, :name)'
        );

        foreach($locations as $location) {
            $stmt->execute([
                ':id' => generateRandomString(32),
                ':name' => $location
            ]);
        }

        return true;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return false;
}

function updateShiftChanges($pdo) {
    $shiftChange = getShiftChange($pdo);

    $now = strtotime('now');
    $then = strtotime($shiftChange['time']);

    $seconds = intval($now - $then);

    if($seconds >= 60 * 60 * 12) {
        try {
            $stmt = $pdo->prepare(
                'INSERT INTO shift_changes(time) ' . 
                'VALUES (DATE_ADD(:time, INTERVAL 12 HOUR))'
            );
    
            $stmt->execute([
                ':time' => $shiftChange['time']
            ]);
    
            return true;
        } catch(PDOException $e) {
            echo 'Error querying database: ' . $e->getMessage();
        }
    }

    return false;
}

function getShiftChange($pdo) {
    try {
        $stmt = $pdo->prepare(
            'SELECT * ' . 
            'FROM shift_changes ' . 
            'ORDER BY time DESC ' . 
            'LIMIT 1'
        );

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return null;
}

function deleteAllAssociateLocations($pdo) {
    try {
        $stmt = $pdo->prepare(
            'DELETE * ' . 
            'FROM associate_locations'
        );

        $stmt->execute();

        return false;
    } catch(PDOException $e) {
        echo 'Error querying database: ' . $e->getMessage();
    }

    return false;
}

function generateRandomString($n) {
    $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $str = '';

    for($i = 0; $i < $n; ++$i) {
        $str .= $chars[rand(0, strlen($chars) - 1)];
    }

    return $str;
}

function sanitize($str) {
    return filter_var(trim($str), FILTER_SANITIZE_STRING);
}

function getTimeAgo($secs) {
    $hours = 0;
    $minutes = 0;
    $seconds = 0;

    $hours = $secs / 3600;

    $minutes = $secs / 60 % 60;

    $seconds = $secs % 60;

    return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
}

/*
function getTimeAgo($seconds) {
    if($seconds < 60) {
        if($seconds > 1) {
            return "$seconds seconds";
        }

        return "$seconds second";
    } else if($seconds < 60 * 60) {
        $minutes = floor($seconds / 60);

        if($minutes > 1) {
            return "$minutes minutes";
        }

        return "$minutes minute";
    }

    else if($seconds < 24 * 60 * 60) {
        $hours = floor($seconds / (60 * 60));

        if($hours > 1) {
            return "$hours hours";
        }

        return "$hours hour";
    }

    $days = floor($seconds / (24 * 60 * 60));

    if($days > 1) {
        return "$days days";
    }

    return "$days day";
}*/