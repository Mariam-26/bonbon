let modal = new Modal('#modal-delete');
let supprimer = document.querySelectorAll(".modal-trigger");

for (let bouton of supprimer) {
    bouton.addEventlistner("click", function() {
        document.querySelector(".modal-footer a").href = `/admin/articles/supprimer/${this.dataset.id}`
        document.querySelector(".modal-content").innerHTML = `Vous êtes sûr de vouloir supprimer l'article "${this.dataset.titre}"`
    });
}