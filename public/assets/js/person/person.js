class Person {
    static initializeDataTable() {

        const dataTable = $('#personDataTable').DataTable({
            serverSide: true,
            order: [],
            ajax: {
                url: "/person/list",
                type: 'GET',
            },
            columns: [
                {data: 'id', name: 'id'},
                {
                    data: 'photo', name: 'photo', render: function (data, type, full, meta) {
                        if (!data) {

                            return `<i class="fas fa-user-circle" style="font-size: 50px;"></i>`;
                        }
                        return `<img style="width: 50px" src="${data}" >`;
                    }
                },
                {data: 'name', name: 'name'},
                {data: 'surname', name: 'surname'},
                {
                    data: 'department_id', name: 'department_id',
                    render: function (data, type, full, meta) {
                       return full.department_name;
                    }
                },
                {data: 'position', name: 'position'},
                {
                    data: 'id', name: 'id',
                    render: function (data, type, full, meta) {
                        return `
                <button class="btn btn-sm bg-primary text-white me-2 personOpenUpdateModalBtn" data-id="${data}"><i class="fa-solid fa-square-pen"></i></button>
                <button class="btn btn-sm bg-danger text-white personDeleteBtn" data-id="${data}"><i class="fa-solid fa-trash"></i></button>`;
                    },
                },
            ],

            initComplete: function () {
                $(".personOpenUpdateModalBtn").on("click", function () {
                    const id = $(this).data("id");

                    $.ajax({
                        type: "get",
                        url: `person/edit/${id}`,
                    }).done(function (response) {
                        $("#name").val(response.person.name);
                        $("#surname").val(response.person.surname);
                        $("#department_id").val(response.person.department_id);
                        $("#position").val(response.person.position);
                        $("#person_id").val(id);
                        $("#photo").attr("src", response.person.photo);

                        $("#updatePersonModal").modal("show");

                    }).fail(function (error) {
                        AlertMessages.showError(error.message, 2000);
                    });

                });

                $(".personDeleteBtn").on("click", function () {

                    const id = $(this).data("id");

                    AlertConfirmModals.confirmModal("Are you sure?", " You won't be able to revert this!", "warning")
                        .then((isConfirmed) => {
                            if (isConfirmed) {
                                $.ajax({
                                    type: 'DELETE',
                                    url: "person/delete",
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
            const columnIndex = $(this).data('column');
            console.log(columnIndex);
            dataTable.column(columnIndex).search($(this).val()).draw();
        });

    }

    static initializeCreatePerson() {
        $("#personCreateBtn").on("click", function () {

            const formData = new FormData($("#personCreateForm")[0]);
            const formAction = $("#personCreateForm").attr("action");
            const formMethod = $("#personCreateForm").attr("method");

            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                contentType: false,
                processData: false,
            }).done(function (response) {
                $("#createPersonModal").modal("hide");
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
                    $("#personCreateErrorContainer").html(errorMessage);
                } else {
                    AlertMessages.showError(error.message, 2000);
                }
            });
        });
    }

    static initializeUpdatePerson() {

        $("#personUpdateBtn").on("click", function () {

            const formData = new FormData($("#personUpdateForm")[0]);
            const formAction = $("#personUpdateForm").attr("action");
            const formMethod = $("#personUpdateForm").attr("method");

            console.log(formData);

            $.ajax({
                type: formMethod,
                url: formAction,
                data: formData,
                contentType: false,
                processData: false,
            }).done(function (response) {
                $("#updatePersonModal").modal("hide");
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
                    $("#personUpdateErrorContainer").html(errorMessage);
                } else {
                    AlertMessages.showError(error.message, 2000);
                }
            });
        });

    }

}
