document.querySelectorAll('.btn-supprimer').forEach(function (lien) {
  lien.addEventListener('click', function (e) {
    if (!confirm('Voulez-vous vraiment supprimer cet exercice ?')) {
      e.preventDefault(); 
    }
  });
});