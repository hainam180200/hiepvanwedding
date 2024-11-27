function deleteData(id) {
    Swal.fire({
        title: '',
        text: "Bạn đồng ý xác nhận xóa?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            document.getElementById('delete-form-' + id).submit();
        }
    })
}

function banData(id, status) {
    let text = parseInt(status) === 1 ? 'Bạn đồng ý xác nhận khoá tài khoản?' : 'Bạn đồng ý muốn khôi phục tài khoản?';
    Swal.fire({
        title: '',
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Đồng ý',
        cancelButtonText: 'Hủy'
    }).then((result) => {
        if (result.value) {
            document.getElementById('ban-form-' + id).submit();
        }
    })
}

function formatCurrency(number){
    var n = number.split('').reverse().join("");
    var n2 = n.replace(/\d\d\d(?!$)/g, "$&.");
    return  n2.split('').reverse().join('');
}