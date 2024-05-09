/**
 * Verify settings component
 */
"use strict";
/* global app, mediaSettings, Dropzone, FileUpload, launchToast, trans  */

Dropzone.autoDiscover = false;

$(function () {
    VerifySettings.initUploader();
});

var VerifySettings = {

    myDropzone : null,
    uploadedFiles: [],

    /**
     * Instantiates the media uploader
     */
    initUploader:function () {
        $("#send-ID-and-selfi").addClass("d-none");
        let selector = '.dropzone';
        VerifySettings.myDropzone = new window.Dropzone(selector, {
            url: app.baseUrl + '/my/settings/verify/upload',
            previewTemplate: document.querySelector('#tpl').innerHTML,
            paramName: "file", // The name that will be used to transfer the file
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            clickable:[".upload-ID" ,".upload-selfi"],
            maxFilesize: mediaSettings.max_file_upload_size, // MB
            addRemoveLinks: true,
            dictRemoveFile: "x",
            acceptedFiles: mediaSettings.allowed_file_extensions,
            // dictDefaultMessage: trans("Drop files here to upload"),
            dictDefaultMessage: trans("Cliquer un par un les bouttons ci-dessous pour selectionnner les differents documents demandés"),
            autoDiscover: false,
            previewsContainer: ".dropzone-previews",
            autoProcessQueue: true,
            parallelUploads: 1,
            // init: function () {
            //     if (VerifySettings.uploadedFiles.length >= 2) { 
            //         $("#send-ID-and-selfi").removeClass("d-none")
            //     }
            // }
        });
        VerifySettings.myDropzone.on("addedfile", file => {
            FileUpload.updatePreviewElement(file, true);
        });
        VerifySettings.myDropzone.on("success", (file, response) => {
            VerifySettings.uploadedFiles.push(response.assetSrc);
            // if ( VerifySettings.uploadedFiles.length >= 2) { 
            //     $("#send-ID-and-selfi").removeClass("d-none")
            // }
            file.upload.assetSrc = response.assetSrc;
        });
        VerifySettings.myDropzone.on("removedfile", function(file) {
            VerifySettings.removeAsset(file.upload.assetSrc);

        });
        VerifySettings.myDropzone.on("error", (file, errorMessage) => {
            if(typeof errorMessage.errors !== 'undefined'){
                // launchToast('danger',trans('Error'),errorMessage.errors.file)
                $.each(errorMessage.errors,function (field,error) {
                    launchToast('danger',trans('Error'),error);
                });
            }
            else{
                if(typeof errorMessage.message !== 'undefined'){
                    launchToast('danger',trans('Error'),errorMessage.message);
                }
                else{
                    launchToast('danger',trans('Error'),errorMessage);
                }
            }
            VerifySettings.myDropzone.removeFile(file);
        });

    },

    /**
     * Removes the uploaded asset
     * @param file
     */
    removeAsset: function (file) {
        $.ajax({
            type: 'POST',
            data: {
                'assetSrc': file,
            },
            url: app.baseUrl + '/my/settings/verify/upload/delete',
            success: function () {
                
                launchToast('success',trans('Success'),trans('Attachment removed.'));
            },
            error: function () {
                launchToast('danger',trans('Error'),trans('Failed to remove the attachment.'));
            }
        });
    }

};
