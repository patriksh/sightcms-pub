crud.field('latest').onChange(function(field) {
    if(field.value == 1) {
        crud.field('article_id').hide();
    } else {
        crud.field('article_id').show();
    }
});