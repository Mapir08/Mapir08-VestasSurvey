$(function(){

  let index = -1;
  let listeIndex = $('#done-candidat ul').children('li');
  let heightOuvert = '350px';
  let heightFerme = '50px';

  $('.done-candidat_voir').click(function(){
    let newIndex = $(this).parent().parent().index();
    let item = listeIndex.eq(newIndex);
    if (newIndex == index){
      animate(item, false);
      index= -1;
    }else{
      let oldItem = listeIndex.eq(index);
      animate(oldItem, false);
      animate(item, true);
      index = newIndex;
    }
  });

  let animate = function($item, toOpen){
    let itemParam = toOpen ? {height: heightOuvert} : {height: heightFerme};
    $item.animate(itemParam);
  };

});