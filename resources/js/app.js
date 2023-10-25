import Dropzone from "dropzone";
 
Dropzone.autoDiscover = false;
 
if(document.getElementById("dropzone")) {
  const dropzone = new Dropzone("#dropzone",{
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar Archivos",
    maxFiles: 1,
    uploadMultiple: false,
  
    init: function(){
      if(  document.querySelector('[name="imagen"]').value.trim())
      {
        const imgPublicada = {}
        imgPublicada.size=1234;
        imgPublicada.name = document.querySelector('[name="imagen"]').value
  
        this.options.addedfile.call($this, imgPublicada);
        this.options.thumbnail.call($this, `/uploads/${imgPublicada.name}`);
  
        imgPublicada.previewElement.classList.add(
          "dz-success",
          "dz-complete"
        )
      }
    }
  
  })
  
  dropzone.on('sending',function (file, xhr, formData){
    console.log(file)
  } )
  
  dropzone.on("success",function(file, response){
    console.log(response)
  
    document.querySelector('[name="imagen"]').value = response.imagen
  })
  
  dropzone.on('removedfile', function(){
    document.querySelector('[name="imagen"]').value=""
  })
}
