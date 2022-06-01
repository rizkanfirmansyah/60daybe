class Crud {
    get(datas) {
        if (datas.parm) {
            if (datas.switch == true) {
                $(`#${datas.table}`).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: datas.url,
                        type: "GET",
                        data: datas.parm,
                    },
                    language: {
                        search: "Search Data:",
                        searchPlaceholder: "Search",
                    },
                    columns: datas.colums,
                    fnDrawCallback: function () {
                        if (datas.callbackButton) {
                            $(
                                `${
                                    datas.callbackButton[0].id
                                        ? datas.callbackButton[0].id
                                        : "#" + datas.table + " .input-toggle"
                                }`
                            ).bootstrapToggle({
                                size: datas.callbackButton[0].size
                                    ? datas.callbackButton[0].size
                                    : "medium",
                                on: datas.callbackButton[0].on
                                    ? datas.callbackButton[0].on
                                    : "Active",
                                onstyle: datas.callbackButton[0].onstyle
                                    ? datas.callbackButton[0].onstyle
                                    : "success",
                                offstyle: datas.callbackButton[0].offstyle
                                    ? datas.callbackButton[0].offstyle
                                    : "danger",
                                off: datas.callbackButton[0].off
                                    ? datas.callbackButton[0].off
                                    : "Inactive",
                            });
                        } else {
                            $(
                                `${"#" + datas.table + " .input-toggle"}`
                            ).bootstrapToggle({
                                size: "medium",
                                on: "Active",
                                onstyle: "success",
                                offstyle: "danger",
                                off: "Inactive",
                            });
                        }
                    },
                });
            } else {
                $(`#${datas.table}`).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: datas.url,
                        type: "GET",
                        data: datas.parm,
                    },
                    language: {
                        search: "Search Data:",
                        searchPlaceholder: "Search",
                    },
                    columns: datas.colums,
                });
            }
        } else {
            if (datas.switch == true) {
                $(`#${datas.table}`).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: datas.url,
                        type: "GET",
                    },
                    language: {
                        search: "Search Data:",
                        searchPlaceholder: "Search",
                    },
                    columns: datas.colums,
                    fnDrawCallback: function () {
                        if (datas.callbackButton) {
                            $(
                                `${
                                    datas.callbackButton[0].id
                                        ? datas.callbackButton[0].id
                                        : "#" + datas.table + " .input-toggle"
                                }`
                            ).bootstrapToggle({
                                size: datas.callbackButton[0].size
                                    ? datas.callbackButton[0].size
                                    : "medium",
                                on: datas.callbackButton[0].on
                                    ? datas.callbackButton[0].on
                                    : "Active",
                                onstyle: datas.callbackButton[0].onstyle
                                    ? datas.callbackButton[0].onstyle
                                    : "success",
                                offstyle: datas.callbackButton[0].offstyle
                                    ? datas.callbackButton[0].offstyle
                                    : "danger",
                                off: datas.callbackButton[0].off
                                    ? datas.callbackButton[0].off
                                    : "Inactive",
                            });
                        } else {
                            $(
                                `${"#" + datas.table + " .input-toggle"}`
                            ).bootstrapToggle({
                                size: "medium",
                                on: "Active",
                                onstyle: "success",
                                offstyle: "danger",
                                off: "Inactive",
                            });
                        }
                    },
                });
            } else {
                $(`#${datas.table}`).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: datas.url,
                        type: "GET",
                    },
                    language: {
                        search: "Search Data:",
                        searchPlaceholder: "Search",
                    },
                    columns: datas.colums,
                });
            }
        }
    }

    async getData(data) {
        const result = await $.ajax({
            url: data.url,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (response) => {
                return response;
            },
            error: (error) => {
                Toast.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    timer: 2000,
                });
            },
        });

        return result;
    }

    post(data) {
        $.ajax({
            type: "POST",
            url: data.url,
            data: data.data,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (response) => {
                if (data.validation == true) {
                    $(".form-text-validation").text(" ");
                    for (const [key, value] of Object.entries(response.data)) {
                        $(`input[name="${key}"]`).removeClass("is-invalid");
                        $(`textarea[name="${key}"]`).removeClass("is-invalid");
                        $(`select[name="${key}"]`).removeClass("is-invalid");
                    }
                }
                this.reload({ url: data.url });
                Toast.fire({
                    icon: "success",
                    title: response.message,
                }).then((result) => {
                    $(".modal").modal("hide");
                });
            },
            error: (error) => {
                if (data.validation == true) {
                    $(".form-text-validation").text(" ");
                    for (const [key, value] of Object.entries(
                        error.responseJSON.data
                    )) {
                        $(`small.${key}`).text(value);
                        $(`input[name="${key}"]`).addClass("is-invalid");
                        $(`textarea[name="${key}"]`).addClass("is-invalid");
                        $(`select[name="${key}"]`).addClass("is-invalid");
                    }
                }
                Toast.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    timer: 2000,
                });
            },
        });
    }

    async edit(data) {
        const result = await $.ajax({
            url: data.url + "/" + data.id,
            headers: {
                "X-CSRF-TOKEN": csrftoken,
            },
            success: (response) => {
                return response.data;
            },
            error: (error) => {
                Toast.fire({
                    icon: "error",
                    title: error.responseJSON.message
                        ? error.responseJSON.message
                        : "Error Unknown",
                    timer: 2000,
                });
            },
        });

        return result;
    }

    async delete(data) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "DELETE",
                    url: data.url,
                    data :{
                        data:data.id
                    },
                    headers: {
                        "X-CSRF-TOKEN": csrftoken,
                    },
                    success: (response) => {
                        Toast.fire({
                            icon: "success",
                            title: response.message,
                        }).then(() => {
                            reloadAjax();
                        });
                    },
                    error: (error) => {
                        Toast.fire({
                            icon: "error",
                            title: error.responseJSON.message,
                            timer: 2000,
                        });
                    },
                });
            }
        });
    }
}
