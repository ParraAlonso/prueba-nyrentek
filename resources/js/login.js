
document.addEventListener('DOMContentLoaded', function () {
    const loadingTitle = document.getElementById('loadingTitle');
    const carousel = document.getElementById('carouselExample');
    if(loadingTitle && carousel){
        axios.post(`${window.location.origin}/api/getLoginCarouselHtml`).then(response =>{
            if(response && response.data){
                carousel.innerHTML=response.data.html;
                loadingTitle.classList.add("d-none");
                carousel.classList.remove("d-none");
            }
        }).catch(e => {
            let error = e.response.data.error ?? '';
            carousel.parentElement.classList.remove("col-md-7");
            carousel.parentElement.classList.add("col-12");
            carousel.parentElement.innerHTML=`<div class="alert alert-danger alert-dismissible text-center small m-0">
                    Ocurrió un error al cargar las imágenes. ${error}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>`;
            console.error(e);
        });
    }
});
