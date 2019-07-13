
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
});

// お気に入りボタン押下でお気に入り登録、解除する処理
$(".fvbtn").click(function () {
    const postId = $(this).data('postid');
    const isFavorite = $(this).hasClass('favorite');
    const urlFavorite  = '/posts/' + postId + '/favorite';  
    const urlUnFavorite  = '/posts/' + postId + '/unfavorite';
    let url;
    let method;

    if (isFavorite) {
        url = urlFavorite;
        method = 'POST';
    } else {
        url = urlUnFavorite;
        method = 'DELETE';
    }
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: method,
        url: url,
        data: {postId: postId, _token: token},
        dataType: 'json'
    })
    .done(function(data) {
        console.log('success');
        console.log(data.fv_cnt);

        if (isFavorite) {
            $('#' + postId).addClass('fas');
            $('#' + postId).removeClass('far');
            $('#' + postId).parent().removeClass('favorite');
            $('#' + postId).parent().addClass('unfavorite');
        } else {
            $('#' + postId).removeClass('fas');
            $('#' + postId).addClass('far');
            $('#' + postId).parent().addClass('favorite');
            $('#' + postId).parent().removeClass('unfavorite');
        }
        // お気に入りに登録しているユーザ数
        $('#cnt' + postId).html(data.fv_cnt);
    });
});
