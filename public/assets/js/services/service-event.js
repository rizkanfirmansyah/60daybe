const crud = new Crud();

$(".eventModal").on("click", function () {
    let param = $(this).data("toggle");
    let target = $(this).data("target");
    $(target).modal("show");
    $(`${target} form`).attr("id", "Input");
    $(`${target} form input`).val("");
    $(`${target} form select`).val("");
    $(`${target} form textarea`).val("");
});


$("table").on("change", ".input-toggle", function () {
    alert($(this).data("value"));
});

$("table").on("click", ".Edit", async function () {
    let url = $(this).data("url");
    let id = $(this).data("id");
    let data = {
        url,id
    };
    let response = await crud.edit(data);
    if (response) {
        $(".modal").modal("show");
        $(".modal form").attr("id", "Update");
        for (const [key, value] of Object.entries(response.data)) {
            if (key == "description" || key == "address") {
                $(`form textarea[name="${key}"]`).val(value);
            } else {
                if (key != "id") {
                    $(`form input[name="${key}"]`).val(value);
                }
            }
            idUpdate = response.data.id;
        }
    }
});

$("table").on("click", ".Delete", function () {
    let url = $(this).data("url");
    let id = $(this).data("id");
    let data = {
        url,id
    };
    crud.delete(data);
});
