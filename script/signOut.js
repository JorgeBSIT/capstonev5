function signOut() {
    swal({
        title: "Signing Out",
        text: "Are you sure you want to sign out?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            swal("Good Bye!", {
            icon: "success",
            });
            window.location = "php/toSignOut.php";
        }
    });
}