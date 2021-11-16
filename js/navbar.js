window.addEventListener('load', () => {

    document.getElementById('btn-login').addEventListener('click', ev => {
        window.open('../views/login.php', "_blank")
    
    });
    
    document.getElementById('btn-ticket').addEventListener('click', ev => {
        window.open('../views/ticket.php', "_blank")
    
    });

    document.getElementById('btn-admin').addEventListener('click', ev => {
        window.open('../views/adm.php', "_blank")
    
    });

});

