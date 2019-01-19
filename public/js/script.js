$(document).ready(function(){
    $('.panel-header').html('SIGN IN');
});


function getUsers() {
    const apiUrl = "http://localhost:80";
    const $list = $('.users-list');

    $.ajax({
        url : apiUrl + '/?page=admin_users',
        dataType : 'json'
    })
        .done((res) => {

            $list.empty();
            //robimy pętlę po zwróconej kolekcji
            //dołączając do tabeli kolejne wiersze
            res.forEach(el => {
                $list.append(`<tr>
                    <td>${el.name}</td>
                    <td>${el.surname}</td>
                    <td>${el.email}</td>
                    <td>${el.role}</td>
                    <td>
                    <button class="btn btn-danger" type="button" onclick="deleteUser(${el.id})">
                        <i class="material-icons">delete_forever</i>
                    </button>
                    </td>
                    </tr>`);
            })
        });
}

$(document).ready(function () {
    console.log("test");
    const apiUrl = "http://localhost:80";
    const $list = $('.items-list');
    $.ajax({
        url : apiUrl + '/?page=admin_items',
        dataType : 'json'
    })
        .done((res) => {

            $list.empty();
            console.log(res);
            //robimy pętlę po zwróconej kolekcji
            //dołączając do tabeli kolejne wiersze
            res.forEach(el => {
                $list.append(`<tr>
                    <td>${el.name}</td>
                    <td>${el.price}</td>
                    <td>
                    <button class="btn btn-danger" type="button" onclick="deleteItem(${el.id_item})">
                        <i class="material-icons">delete_forever</i>
                    </button>
                    </td>
                    </tr>`);
            })
        });
})

$(document).ready(function () {
    console.log("test2");
    const apiUrl = "http://localhost:80";
    const $list2 = $('.itemstorent-list');
    $.ajax({
        url : apiUrl + '/?page=upload',
        dataType : 'json'
    })
        .done((res) => {

            $list2.empty();
            console.log(res);
            //robimy pętlę po zwróconej kolekcji
            //dołączając do tabeli kolejne wiersze
            res.forEach(el => {
                $list.append(`<tr>
                    <td>${el.name}</td>
                    <td>${el.price}</td>
                    <td>
                    <a href="mailto:rentgreat@equipment.pl">send a request</a>
                    </td>
                    
                    </tr>`);
            })
        });
})
function deleteUser(id) {
    if (!confirm('Do you want to delete this user?')) {
        return;
    }

    const apiUrl = "http://localhost:80";

    $.ajax({
        url : apiUrl + '/?page=admin_delete_user',
        method : "POST",
        data : {
            id : id
        },
        success: function() {
            alert('Selected user successfully deleted from database!');
            getUsers();
        }
    });
}


function deleteItem(id) {
    if (!confirm('Do you want to delete this item?')) {
        return;
    }

    const apiUrl = "http://localhost:80";

    $.ajax({
        url : apiUrl + '/?page=admin_delete_item',
        method : "POST",
        data : {
            id_item : id
        },
        success: function() {
            alert('Selected item successfully deleted from database!');
            getUsers();
        }
    });
}