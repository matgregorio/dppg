document.addEventListener('DOMContentLoaded', function(){
    const links = document.querySelectorAll('.sidebar a');
    const contentDiv = document.getElementById('content');

    links.forEach(link => {
        link.addEventListener('click', function(e){
            e.preventDefault();
            const content = this.getAttribute('data-content');
            loadContent(content);
        });
    });

    function loadContent(content){
        fetch(content + '.php')
        .then(response =>{
            if(!response.ok){
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(html => {
            contentDiv.innerHTML = html;
        })
        .catch(error => {
            contentDiv.innerHTML = '<h1>Error</h1><p>Could not load content.Please try again later.</p>';
            console.error('There has been a problem with your fetch operation: ', error);
        })
    }
})