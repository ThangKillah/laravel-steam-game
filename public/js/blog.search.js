var elements = document.getElementsByClassName("column");
// Declare a loop variable
var i;
var current_layout = 'grid';

// List View
function listView() {
    current_layout = 'list';
    for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "100%";
    }
}

// Grid View
function gridView() {
    current_layout = 'grid';
    for (i = 0; i < elements.length; i++) {
        elements[i].style.width = "50%";
    }
}

var page = 1;
var title = '';
var platform = '';
var sortBy = '1';
var load_by_hash_change = 1;

$('#title-blog-search').on('change', function () {
    page = 1;
    title = $('#title-blog-search').val();
    getData(page);
});

$('.drop-platform').on('click', function () {
    if (!$(this).hasClass('active')) {
        page = 1;
        $('.drop-platform').removeClass('active');
        $(this).addClass('active');
        platform = $(this).data('id');
        $('#span-platform').html($(this).html());
        getData(page);
    }
});

$('.drop-sort').on('click', function () {
    if (!$(this).hasClass('active')) {
        page = 1;
        $('.drop-sort').removeClass('active');
        $(this).addClass('active');
        sortBy = $(this).data('id');
        $('#span-sort').html($(this).html());
        getData(page);
    }
});

$(window).on('hashchange', function () {
    if (window.location.hash) {
        page = window.location.hash.replace('#', '');
        if (page == Number.NaN || page <= 0) {
            return false;
        } else {
            if (load_by_hash_change) {
                getData(page);
            }
        }
    }
});

$(document).ready(function () {
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();

        $('li').removeClass('active');
        $(this).parent('li').addClass('active');

        page = $(this).attr('href').split('page=')[1];

        getData(page);
    });

});

function getData(page) {
    $.ajax({
        url: '/blog-list-ajax' + '?page=' + page + '&title=' + title + '&platform=' + platform + '&sortBy=' + sortBy + '&game_id=' + $('#game-id').val(),
        type: "get",
        datatype: "html",
        beforeSend: function () {
            showAjaxGif();
        },
        success: function (data) {
            load_by_hash_change = 0;
            hideAjaxGif();
            $("#blog-list").empty().html(data);
            $('html, body').animate({scrollTop: $('#blog-list').position().top}, 'slow');
            if (current_layout === 'grid') {
                gridView();
            } else {
                listView();
            }
            $('[data-toggle="tooltip"]').tooltip();
            location.hash = page;
            setTimeout(function () {
                load_by_hash_change = 1
            }, 500);
            $("img").each(function () {
                console.log('img-fail-load');
                $(this).attr("onerror", "this.src='/img/bg-empty.jpeg'");
            });
        },
        error: function (request, status, error) {
            hideAjaxGif();
        }
    });
}