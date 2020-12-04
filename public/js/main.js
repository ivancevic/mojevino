const vina = document.getElementById('vina');

if (vina) {
    vina.addEventListener('click', e => {
        if (e.target.className === 'btn btn-danger delete-vino') {
            if (confirm('Are you sure?')) {
                const id = e.target.getAttribute('data-id');
                
                fetch(`/vino/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}

$(function () {

        $(window).on('scroll', function() {
            if($(window).scrollTop() > 10) {
                $('.navbar').addClass('active');
            } else {
                $('.navbar').removeClass('active');
            }
        });

});