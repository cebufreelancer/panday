$(function(){
  $(".case_row").click(function(){
    id = $(this).attr('data-id');
    price = $(this).attr('price');
    if (!$(this).hasClass('added')){
      $(this).addClass("added");
      $("<i class='icon-ok'>").appendTo($(this));

      $.ajax({
        type: 'POST',
        url: "/addtocart",
        data: "id=" + id,
        success: function(data){
          console.log(data);
          if (data == "success"){
            $("#cart").hide();
            $("#cart span").text($(".added").length + " items");
            $("#cart").fadeIn();
          
          }
        }
      });
    }

  });    
})
