(function($){
  // EVENTS
  //   fileAdded
  //   uploadStarted
  //   progress
  //   fileComplete
  //   uploadComplete
  S3UploadQueue = function(options){
    this.init(options);
  };

  $.extend(S3UploadQueue.prototype, {
    // default options
    //
    // EVENTS
    //
    options: {keyPrefix: '',
              // events!
              fileAdded: function(file){},
              signatureReceived: function(file){},
              fileComplete: function(file){},
              uploadStarted: function(){},
              uploadComplete: function(){},
              progress: function(progress){}},

    init: function(options){
      // the 'files' attribute is a collection of these guys:
      // {fileName: <filename>,
      //  signature: <signature>,
      //  file: <file>}
      this.files = [];
      var ref = this;

      $.extend(ref.options, options);
    },

    add: function(file){
      ref.fileWithoutSignature += 1;

      // grab the s3 signature
      var ref = this;
      var fileRep = {fileName: file.fileName, file: file};
      var fileIdx = ref.files.length;
      ref.files[fileIdx] = fileRep;
      
      // trigger the first 'file added' callback
      ref.options.fileAdded.call(ref, fileRep);

      $.getJSON('/s3_uploads/signature',
                {key: ref.keyPrefix + file.fileName, content_type: file.type},
                function(data){
                  var fileEl = ref.files[fileIdx];
                  fileEl.signature = data; 
                  ref.options.signatureReceived.call(ref, fileEl);
                  ref.fileWithoutSignature -= 1;

                  if(uploadRequested){
                    ref.upload();
                  }
                });
    },

    // Trigger the upload.
    // This is actually an asynchronous call -- it triggers once all the objects in 'this.files'
    // have a signature
    upload: function(){ 
      if(this.uploadRequested && fileWithoutSignature === 0){

      }
    },

    // stub this method for now
    remove: function(file){ return true; },

    // counters
    fileWithoutSignature: 0,
    uploadRequested: false
  });
})(jQuery);
