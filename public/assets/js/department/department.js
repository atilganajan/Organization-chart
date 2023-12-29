class Department {
    static initializeDataTable(url) {
        const dataTable = $('#departmentDataTable').DataTable({
            serverSide: true,
            order: [],
            ajax: {
                url: url,
                type: 'GET',
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'parent_department_name', name: 'parentDepartment.name', defaultContent: '-'},
                {
                    data: 'id', name: 'id',
                    render: function (data, type, full, meta) {
                        data = `
                <button class="btn btn-sm bg-primary text-white me-2 dapertmentOpenUpdateModalBtn " data-id="${data.id}" ><i class="fa-solid fa-square-pen"></i></button>
                <button class="btn btn-sm bg-danger text-white dapertmentDeleteBtn " data-id="${data.id}" ><i class="fa-solid fa-trash"></i></button>`

                        return data;

                    },


                },
            ],
        });

        $('.filter-input').on('keyup', function () {
            const columnIndex = $(this).data('column');
            dataTable.column(columnIndex).search($(this).val()).draw();
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
                    $("#departmentErrorContainer").html(errorMessage);
                } else {
                    AlertMessages.showError(response.message, 2000);
                }
            });
        });
    }

}
