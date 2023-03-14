
document.getElementById('cacheCleaner').addEventListener('click', function(event){
    event.preventDefault();
    getCоntеnt(document.getElementById('cacheCleaner').querySelector('.nav-link').getAttribute('href'), {
        _method: "GET",
        _token: document.querySelector('meta[name=csrf-token]').content,
    }) .then((data) => {
        //console.log(data);
        if(data == 200){
            Swal.fire({
                title: 'Кеш очищен!',
                html: 'Кеш Вашего приложения успешно очищен',
                icon: 'success',
                timer: 1500
            });
        }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Не удалось очистить кеш'
            });
        }
    });

    async function getCоntеnt(url = '', data = {}) {
        // Default options are marked with *
        const response = await fetch(url, {
            method: 'POST',
            credentials: 'same-origin', // include, *same-origin, omit
            headers: {
                //'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                'Content-Type': 'application/json'
            },
            redirect: 'follow', // manual, *follow, error
            referrerPolicy: 'no-referrer', // no-referrer, *client
            body: JSON.stringify(data) // body data type must match "Content-Type" header
        });
        return await response.text(); // parses JSON response into native JavaScript objects
    }
});
