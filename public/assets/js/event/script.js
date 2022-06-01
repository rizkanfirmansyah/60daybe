const crud = new Crud();

$(document).ready(function () {
    showData({ url: $("#modalEvent form").attr("action") });

    $("#content-parameter").on("click", "a", function () {
        showData({ url: $("#modalEvent form").attr("action") });
    });

    $("#content-parameter").on("click", "a", function () {
        $("#content-parameter a").removeClass("active");
        $(this).addClass("active");
    });

    if (
        $("#modalEvent .modal-body form").length > 0 &&
        $("#modalEvent .modal-body form input").length > 0
    ) {
        $("#addData").removeAttr("disabled");
    }

    $("#addData").on("click", function () {
        if ($("#modalEvent .modal-body").text().indexOf("form") > 0) {
            alert("Not Action in Modal");
        }

        let title = $("#modalEvent .modal-body form").data("title");
        $("#modalEvent").modal("show");
        $("#modalEvent .modal-title").text(title);
    });

    $("#modalEvent form").on("submit", function (e) {
        e.preventDefault();
        let method = $(this).attr("method");
        let action = $(this).attr("action");
        const reload = $(this).data("reload");
        var formData = new FormData(this);

        if (method.toLowerCase() === "post") {
            removeErrors();
            onSubmit({ method, action, formData, reload });
        } else if (method.toLowerCase() === "put") {
            removeErrors();
            method = "POST";
            action = action + "/" + idUpdate;
            onSubmit({ method, action, formData, reload });
        }
    });

    $("table").on("click", ".Edit", async function () {
        let url = $("#modalEvent form").attr("action");
        let id = $(this).data("id");

        try {
            let data = await crud.edit({ url, id });
            for (const [key, value] of Object.entries(data.data)) {
                $(`form [name="${key}"]`).val(value);
            }
            idUpdate = data.data.id;
            $("#modalEvent form").attr("method", "put");
            $("#modalEvent").modal("show");
        } catch (error) {
            console.log(error);
        }
    });

    $("table").on("click", ".Delete", function () {
        let id = $(this).data("id");
        let url = $("#modalEvent form").attr("action");

        crud.delete({ url, id });
    });

    $("#deleteData").on("click", function () {
        let id = valueCheckbox;
        let url = $("#modalEvent form").attr("action");
        crud.delete({ url, id });
    });

    $("table").on("change", ".input-toggle", function () {
        $.ajax({
            method: "PUT",
            url: $("#modalEvent form").attr("action") + "/change/status",
            data: {
                value: $(this).data("value"),
            },
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (res) => {
                Toast.fire({
                    icon: "success",
                    title: res.message,
                    timer: 2000,
                }).then(() => {
                    reloadAjax();
                });
            },
            error: (err) => {
                Toast.fire({
                    icon: "error",
                    title: err.responseJSON.message,
                    timer: 2000,
                });
            },
        });
    });
});

function onSubmit({ action, method, formData, reload }) {
    if (reload == "no") {
        $.ajax({
            url: action,
            method: method,
            contentType: false,
            processData: false,
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (res) => {
                const response = res.data;
                Toast.fire({
                    icon: "success",
                    title: res.message,
                }).then(() => {
                    $("#modalEvent").modal("hide");
                    for (const [key, value] of Object.entries(response)) {
                        $(`form [name="${key}"]`).val("");
                    }
                });
            },
            error: (err) => {
                if (err.responseJSON.data) {
                    const error = err.responseJSON.data;
                    for (const [key, value] of Object.entries(error)) {
                        let errorHtml = document.createElement("span");
                        errorHtml.className = "text-danger";
                        errorHtml.textContent = value;
                        $(`form [name="${key}"]`).addClass("is-invalid");
                        $(errorHtml).insertAfter(`form [name="${key}"]`);
                    }
                }
            },
        });
    } else {
        $.ajax({
            url: action,
            method: method,
            contentType: false,
            processData: false,
            data: formData,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (res) => {
                reloadAjax();
                const response = res.data;
                Toast.fire({
                    icon: "success",
                    title: res.message,
                }).then(() => {
                    $("#modalEvent").modal("hide");
                    for (const [key, value] of Object.entries(response)) {
                        $(`form [name="${key}"]`).val("");
                    }
                    $("#modalEvent form").attr("method", "post");
                });
            },
            error: (err) => {
                if (err.responseJSON.data) {
                    const error = err.responseJSON.data;
                    for (const [key, value] of Object.entries(error)) {
                        let errorHtml = document.createElement("span");
                        errorHtml.className = "text-danger";
                        errorHtml.textContent = value;
                        $(`form [name="${key}"]`).addClass("is-invalid");
                        $(errorHtml).insertAfter(`form [name="${key}"]`);
                    }
                }
            },
        });
    }
}
