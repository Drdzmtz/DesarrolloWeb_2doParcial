window.addEventListener('load', () => {

    document.getElementById('btn-login').addEventListener('click', ev => {
        window.location = '../views/login.php'
    
    });
    
    document.getElementById('btn-ticket').addEventListener('click', ev => {
        window.location = '../views/ticket.php'
    
    });

    document.getElementById('btn-admin').addEventListener('click', ev => {
        window.location = '../views/adm.php'
    
    });

});

