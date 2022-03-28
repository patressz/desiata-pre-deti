$( document ).ready(function() {

    $('.children-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete odstrániť dieťa?',
            text: "Všetky objednávky patriace tomúto dieťaťu budú odstránené! Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, odstrániť!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit()

            }
          });
    });

    $('.order-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete stornovať objednávku?',
            text: "Kredit v hodnote objednávky Vám bude vrátený. Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, stornovať!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit()

            }
          });
    });

    $('.admin-order-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete stornovať objednávku?',
            text: "Kredit v hodnote objednávky bude používateľovi vrátený. Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, stornovať!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit()

            }
          });
    });

    $('.product-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete vymazať tento produkt?',
            text: "Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, vymazať!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit();

            }
          });
    });

    $('.allergen-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete vymazať tento alergén?',
            text: "Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, vymazať!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit();

            }
          });
    });

    $('.user-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete odstrániť tohto používateľa?',
            text: "Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, odstrániť!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit();

            }
          });
    });

    $('.generate-password').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete vygenerovať nové heslo pre tohto používateľa?',
            text: "Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, vygenerovať!'
          }).then((result) => {
            if (result.isConfirmed) {

                $('#generate_new_password').submit();

            }
          });
    });

    $('.school-destroy').on('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Naozaj chcete odstrániť túto školu?',
            text: "Túto akciu nebudete môcť vrátiť späť!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Zrušiť',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Áno, odstrániť!'
          }).then((result) => {
            if (result.isConfirmed) {

                this.closest('form').submit();

            }
          });
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

});
