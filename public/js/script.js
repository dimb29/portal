function copyInputLink(){
    alert("holaa");
    // Get the text field
    var copyText = document.getElementById("input_link");
  
    // Select the text field
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices
  
     // Copy the text inside the text field
    navigator.clipboard.writeText(copyText.value);
  
    // Alert the copied text
    alert("Copied the text: " + copyText.value);
    
}

function hideScroll(){
  // lock scroll position, but retain settings for later
  var scrollPosition = [
  self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
  self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
  ];
  var html = jQuery('html'); // it would make more sense to apply this to body, but IE7 won't have that
  html.data('scroll-position', scrollPosition);
  html.data('previous-overflow', html.css('overflow'));
  html.css('overflow', 'hidden');
  window.scrollTo(scrollPosition[0], scrollPosition[1]);
}

function showScroll(){
  var html = jQuery('html');
  var scrollPosition = html.data('scroll-position');
  html.css('overflow', html.data('previous-overflow'));
  window.scrollTo(scrollPosition[0], scrollPosition[1])
}
function openFilter(id){
    if(id == 1){
        if($("#dropdown1").is(':hidden')){
            $("#dropdown1").slideDown();
            $("#dropdown2").slideUp();
            $("#dropdown3").slideUp();
            $("#angle1").toggleClass('flip-180');
        }else{
            $("#dropdown1").slideUp();
            $("#dropdown2").slideUp();
            $("#dropdown3").slideUp();
            $("#angle1").toggleClass('flip-180');
        }
        if($("#dropdown2").is(':visible')){
            $("#angle2").toggleClass('flip-180');
        }
        if($("#dropdown3").is(':visible')){
            $("#angle3").toggleClass('flip-180');
        }
    }else if(id == 2){
        if($("#dropdown2").is(':hidden')){
            $("#dropdown1").slideUp();
            $("#dropdown2").slideDown();
            $("#dropdown3").slideUp();
            $("#angle2").toggleClass('flip-180');
        }else{
            $("#dropdown1").slideUp();
            $("#dropdown2").slideUp();
            $("#dropdown3").slideUp();
            $("#angle2").toggleClass('flip-180');
        }
        if($("#dropdown1").is(':visible')){
            $("#angle1").toggleClass('flip-180');
        }
        if($("#dropdown3").is(':visible')){
            $("#angle3").toggleClass('flip-180');
        }
    }else if(id == 3){
        if($("#dropdown3").is(':hidden')){
            $("#dropdown1").slideUp();
            $("#dropdown2").slideUp();
            $("#dropdown3").slideDown();
            $("#angle3").toggleClass('flip-180');
        }else{
            $("#dropdown1").slideUp();
            $("#dropdown2").slideUp();
            $("#dropdown3").slideUp();
            $("#angle3").toggleClass('flip-180');
        }
        if($("#dropdown1").is(':visible')){
            $("#angle1").toggleClass('flip-180');
        }
        if($("#dropdown2").is(':visible')){
            $("#angle2").toggleClass('flip-180');
        }
    }

}
function countText(){
  var count = $('#deskripsi').val().length;
  // alert('pressed =' + count);
  window.livewire.emit('countText', count);
}
function toPosts(){
  // alert('hahahahahahahahahaha Peace Masgasso');
  window.livewire.emit('closeComplain', false);
}
// Remove Alert Kuy
function autoremoveNotif(){
  window.livewire.on('alert_remove',()=>{
      setTimeout(function(){ $(".alert-success").fadeOut('fast');
      }, 3000); // 3 secs
  });
}

function getCkeditor(){
    ClassicEditor
        .create(document.querySelector('.contents'))
        .then( editor => {
            const toolbarElement = editor.ui.view.toolbar.element;
            toolbarElement.style.display = "none";
            editor.enableReadOnlyMode( '#content' );
        } )
        .catch(error => {
            console.error(error);
        });
}