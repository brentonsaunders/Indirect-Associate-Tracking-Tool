$(function() {
    $('#menu-button').click(function() {
        $('.wrapper').toggleClass('menu-open');
    });

    $('main').click(function() {
        $('.wrapper').removeClass('menu-open');
    });

    if($('#location-changer').length > 0) {
        changeLocation();
    }

    $('#change-location').click(function() {
        changeLocation();
    });

    function addNote(userLocationId) {
        $.get(
            'add-note.php',
            {
                'user-location-id': userLocationId,
                'note': $('#note').val()
            })
        .done(function(data) {
            $('#location-changed > h1').text('Note added!');
            $('#add-note').hide();
            $('#note').hide();
        })
        .fail(function() {
        });
    }

    function changeLocation() {
        const video = document.createElement('video');
        const canvas = $('#qr-canvas')[0];
        const context = canvas.getContext('2d');

        let scanning = false;

        $('#location-changed').hide();
        $('#opening-camera').show();
        $(canvas).show();

        qrcode.callback = (result) => {
            if (result) {
                $.get(
                    'move-associate.php',
                    {
                        'associate-id': associateId,
                        'location-id': result
                    })
                .done(function(data) {
                    $('#location-changed').show();
                    $('#add-note').show();
                    $('#note').show();
                    $('#note').val('');
                    $('#location-changed > h1').text(`Your location has been changed to ${data['location-name']} at ${data['time']}.`);

                    const userLocationId = data['user-location-id'];

                    $('#add-note').click(function() {
                        addNote(userLocationId);
                    });

                    scanning = false;
    
                    video.srcObject.getTracks().forEach(track => {
                        track.stop();
                    });
                    
                    $(canvas).hide();
                })
                .fail(function() {
                    setTimeout(scan, 1000);
                });
            }
        };

        navigator.mediaDevices
        .getUserMedia({ video: {facingMode: 'environment'} })
        .then(function(stream) {
            scanning = true;

            $('#opening-camera').hide();

            video.setAttribute('playsinline', true); // required to tell iOS safari we don't want fullscreen
            video.srcObject = stream;
            video.play();
            
            tick();
            scan();
        });

        function tick() {
            canvas.height = video.videoHeight;
            canvas.width = video.videoWidth;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
            scanning && requestAnimationFrame(tick);
        }

        function scan() {
            try {
                qrcode.decode();
            } catch (e) {
                setTimeout(scan, 300);
            }
        }
    }
});