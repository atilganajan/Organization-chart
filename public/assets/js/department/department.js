class Department {
    static initializeDataTable() {

        const dataTable = $('#departmentDataTable').DataTable({
            serverSide: true,
            order: [],
            ajax: {
                url: "/department/list",
                type: 'GET',
            },
            columns: [
                {data: 'id', name: 'id'},
                {
                    data: 'id', name: 'id', render: function (data, type, full, meta) {
                        return full.name ;
                    }
                },
                {
                    data: 'parent_department_id',
                    name: 'parent_department_id',
                    render: function (data, type, full, meta) {
                        return full.parent_department_name ?? "-";
                    }
                },
                {
                    data: 'id', name: 'id',
                    render: function (data, type, full, meta) {
                        return `
                <button class="btn btn-sm bg-primary text-white me-2 departmentOpenUpdateModalBtn" data-id="${data}"><i class="fa-solid fa-square-pen"></i></button>
                <button class="btn btn-sm bg-danger text-white dapertmentDeleteBtn" data-id="${data}"><i class="fa-solid fa-trash"></i></button>`;
                    },
                },
            ],

            initComplete: function () {
                $(".departmentOpenUpdateModalBtn").on("click", function () {
                    const id = $(this).data("id");

                    $.ajax({
                        type: "get",
                        url: `department/edit/${id}`,
                    }).done(function (response) {
                        $("#updateDepartmentName").val(response.department.name);
                        $("#updateDepartmentSelect").val(response.department.parent_department?.id ?? "");
                        $("#department_id").val(id);

                        $("#updateDepartmentModal").modal("show");

                    }).fail(function (error) {
                        AlertMessages.showError(error.message, 2000);
                    });

                });

                $(".dapertmentDeleteBtn").on("click", function () {

                    const id = $(this).data("id");

                    AlertConfirmModals.confirmModal("Are you sure?", "Do you confirm that the departments and persons affiliated with it will also be deleted? <br><br> You won't be able to revert this!", "warning")
                        .then((isConfirmed) => {
                            if (isConfirmed) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: "department/delete",
                                    data: {
                                        id: id,
                                    },
                                }).done(function (response) {
                                    AlertMessages.showSuccess(response.message, 2000);
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 2000);
                                }).fail(function (error) {
                                    AlertMessages.showError(error.message, 2000);
                                });
                            }
                        });
                });


            },

        });

        $('.filter-input').on('keyup change', function () {
            dataTable.columns($(this).parent().index()).search(this.value).draw();
        });


    }

    static initializeCreateDepartment() {
        $("#departmentCreateBtn").on("click", function () {

            const formData = $("#departmentCreateForm").serialize();
            const formAction = $("#departmentCreateForm").attr("action");
            const formMethod = $("#departmentCreateForm").attr("method");

            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
            }).done(function (response) {
                $("#createDepartmentModal").modal("hide");
                AlertMessages.showSuccess(response.message, 2000);

                setTimeout(function () {
                    location.reload();
                }, 2000)

            }).fail(function (error) {
                if (error.status === 422) {
                    const errors = error.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, (key, value) => {
                        errorMessage += `<li class="text-danger" >${value[0]}</li>`;
                    });
                    $("#departmentCreateErrorContainer").html(errorMessage);
                } else {
                    AlertMessages.showError(error.message, 2000);
                }
            });
        });
    }

    static initializeUpdateDepartment() {

        $("#departmentUpdateBtn").on("click", function () {

            const formData = $("#departmentUpdateForm").serialize();
            const formAction = $("#departmentUpdateForm").attr("action");
            const formMethod = $("#departmentUpdateForm").attr("method");

            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
            }).done(function (response) {
                $("#updateDepartmentModal").modal("hide");
                AlertMessages.showSuccess(response.message, 2000);

                setTimeout(function () {
                    location.reload();
                }, 2000)

            }).fail(function (error) {
                if (error.status === 422) {
                    const errors = error.responseJSON.errors;
                    let errorMessage = '';
                    $.each(errors, (key, value) => {
                        errorMessage += `<li class="text-danger" >${value[0]}</li>`;
                    });
                    $("#departmentUpdateErrorContainer").html(errorMessage);
                } else {
                    AlertMessages.showError(error.message, 2000);
                }
            });
        });

    }

}
