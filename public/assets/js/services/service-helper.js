let csrftoken = $('meta[name="csrf-token"]').data("token");
let idUpdate = null;
const valueCheckbox = [];

const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    timer: 2000,
    timerProgressBar: true,
    showConfirmButton: false,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Toast.stopTimer);
        toast.addEventListener("mouseleave", Toast.resumeTimer);
    },
});

function checkboxAll(val) {
    var checkbox = $('table input[name="checkbox"]');
    if (checkbox.length > 0) {
        for (i = 0; i < checkbox.length; i++) {
            if (val.checked) {
                checkbox[i].checked = true;
                valueCheckbox.push(checkbox[i].value);
            } else {
                checkbox[i].checked = false;
                var index = valueCheckbox.indexOf(checkbox[i].value);

                if (index > -1) {
                    valueCheckbox.splice(index, 1);
                }
            }
        }
    } else {
        if (val.checked) {
            checkbox.checked = true;
        } else {
            checkbox.checked = false;
        }
    }
    if (valueCheckbox.length > 0) {
        $("#deleteData").removeAttr("disabled");
    } else {
        $("#deleteData").attr("disabled", true);
    }
}

function checkboxThis(val) {
    if (val.checked) {
        $(this).checked = true;
        valueCheckbox.push(val.value);
    } else {
        $(this).checked = false;
        var index = valueCheckbox.indexOf(val.value);

        if (index > -1) {
            valueCheckbox.splice(index, 1);
        }
    }
    if (valueCheckbox.length > 0) {
        $("#deleteData").removeAttr("disabled");
    } else {
        $("#deleteData").attr("disabled", true);
    }
}

async function getDataShow(url) {
    let result = await crud.getData({ url: url });
    return result;
}

function run(url) {
    getDataShow(url).then((res) => {
        for (const [key, value] of Object.entries(res.data)) {
            $(`span#${key}`).text(value);
        }
    });
}

function removeErrors(){
    $('.is-invalid').removeClass('is-invalid');
    $('form span.text-danger').remove();
}

function reloadAjax(data = null) {
    if (data != null) {
        let table = $(`#${data}`).DataTable();
        table.ajax.reload(null, true);
    } else {
        let table = $("table").DataTable();
        table.ajax.reload(null, true);
    }
}

function showData(data){
    $.ajax({
        url:data.url + "/show",
        success:res=>{
            for (const [key, value] of Object.entries(res.data)) {
                $(`#${key}Tab`).text(value);
                $(`#${key}TabList`).removeClass('d-none');
            }
        },
        error:err=>{
            console.log(err);
        }
    })
}
