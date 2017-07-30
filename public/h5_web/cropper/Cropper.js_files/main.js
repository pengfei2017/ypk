window.onload = function () {
    var final_width = 400;
    var final_height = 400;

    'use strict';

    var Cropper = window.Cropper;
    var URL = window.URL || window.webkitURL;
    var container = document.querySelector('.img-container');
    var image = container.getElementsByTagName('img').item(0);
    var download = document.getElementById('download');
    var actions = document.getElementById('actions');
    var options = {
        aspectRatio: 1 / 1,
        cropBoxResizable: true,
        dragMode: 'move'
        //autoCropArea: 400 / ($('.img-container').width() > $('.img-container').height() ? $('.img-container').height() : $('.img-container').width())
    };
    var cropper = new Cropper(image, options);
    var originalImageURL = image.src;
    var uploadedImageURL;

    // Buttons
    if (!document.createElement('canvas').getContext) {
        $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
    }

    if (typeof document.createElement('cropper').style.transition === 'undefined') {
        $('button[data-method="rotate"]').prop('disabled', true);
        $('button[data-method="scale"]').prop('disabled', true);
    }


    // Download
    if (typeof download.download === 'undefined') {
        download.className += ' disabled';
    }


    // Options
    actions.querySelector('.docs-toggles').onchange = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var cropBoxData;
        var canvasData;
        var isCheckbox;
        var isRadio;

        if (!cropper) {
            return;
        }

        if (target.tagName.toLowerCase() === 'label') {
            target = target.querySelector('input');
        }

        isCheckbox = target.type === 'checkbox';
        isRadio = target.type === 'radio';

        if (isCheckbox || isRadio) {
            if (isCheckbox) {
                options[target.name] = target.checked;
                cropBoxData = cropper.getCropBoxData();
                canvasData = cropper.getCanvasData();

                options.ready = function () {
                    console.log('ready');
                    cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                };
            } else {
                options[target.name] = target.value;
                options.ready = function () {
                    console.log('ready');
                };
            }

            // Restart
            cropper.destroy();
            cropper = new Cropper(image, options);
        }
    };


    // Methods
    actions.querySelector('.docs-buttons').onclick = function (event) {
        var e = event || window.event;
        var target = e.target || e.srcElement;
        var result;
        var input;
        var data;

        if (!cropper) {
            return;
        }

        while (target !== this) {
            if (target.getAttribute('data-method')) {
                break;
            }

            target = target.parentNode;
        }

        if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
            return;
        }

        data = {
            method: target.getAttribute('data-method'),
            target: target.getAttribute('data-target'),
            option: target.getAttribute('data-option'),
            secondOption: target.getAttribute('data-second-option')
        };

        if (data.method) {
            if (typeof data.target !== 'undefined') {
                input = document.querySelector(data.target);

                if (!target.hasAttribute('data-option') && data.target && input) {
                    try {
                        data.option = JSON.parse(input.value);
                    } catch (e) {
                        console.log(e.message);
                    }
                }
            }

            if (data.method === 'getCroppedCanvas') {
                data.option = JSON.parse(data.option);
                // 这是我添加的接收图片最终尺寸
                data.option = {width: final_width, height: final_height};
            }

            result = cropper[data.method](data.option, data.secondOption);

            switch (data.method) {
                case 'scaleX':
                case 'scaleY':
                    target.setAttribute('data-option', -data.option);
                    break;

                case 'getCroppedCanvas':
                    if (result) {

                        // Bootstrap's Modal
                        $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                        if (!download.disabled) {
                            $(download).attr("baseImgData", result.toDataURL('image/jpeg'));
                        }
                    }

                    break;

                case 'destroy':
                    cropper = null;

                    if (uploadedImageURL) {
                        URL.revokeObjectURL(uploadedImageURL);
                        uploadedImageURL = '';
                        image.src = originalImageURL;
                    }

                    break;
            }

            if (typeof result === 'object' && result !== cropper && input) {
                try {
                    input.value = JSON.stringify(result);
                } catch (e) {
                    console.log(e.message);
                }
            }
        }
    };

    document.body.onkeydown = function (event) {
        var e = event || window.event;

        if (!cropper || this.scrollTop > 300) {
            return;
        }

        switch (e.keyCode) {
            case 37:
                e.preventDefault();
                cropper.move(-1, 0);
                break;

            case 38:
                e.preventDefault();
                cropper.move(0, -1);
                break;

            case 39:
                e.preventDefault();
                cropper.move(1, 0);
                break;

            case 40:
                e.preventDefault();
                cropper.move(0, 1);
                break;
        }
    };

    // Import image
    window.addEventListener("message", function (e) {
        if (cropper) {
            image.src = uploadedImageURL = e.data.uploadedImageURL;
            final_width = e.data.width;
            final_height = e.data.height;
            cropper.destroy();
            cropper = new Cropper(image, options);
        }
        //ajaxFileUpload();
    }, false);
    $(download).click(function () {
        $("#getCroppedCanvasModal").modal('hide');
        window.parent.postMessage($(this).attr("baseImgData"), "*");
    });
    $('#cansel').click(function () {
        window.parent.postMessage("close_cropper", "*");
    });
    function ajaxFileUpload() {
        $.ajaxFileUpload({
            url: ApiUrl + '/member_index/pic_upload?form_submit=ok&key=' + key + '&uploadpath=chat_image/' + memberInfo.member_id,
            secureuri: false,
            fileElementId: '_pic',
            dataType: 'json',
            success: function (data, status) {
                if (data.status == 1) {
                    $('#msg').val('<img src="' + data.url + '">');
                } else {

                }
            },
            error: function (data, status, e) {
            }
        })
    }
};

