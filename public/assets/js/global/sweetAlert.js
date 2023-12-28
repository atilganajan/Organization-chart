class AlertMessages {
    static showAlerts(message, icon, timer) {
        Swal.fire({
            icon: icon,
            html: message,
            showConfirmButton: false,
            timer: timer
        });
    }
    static showSuccess(message, timer) {
        this.showAlerts(message, "success", timer);
    }

    static showError(message, timer) {
        this.showAlerts(message, "error", timer);
    }

    static showWarning(message, timer) {
        this.showAlerts(message, "warning", timer);
    }

    static showInfo(message, timer) {
        this.showAlerts(message, "info", timer);
    }
}

class AlertConfirmModals {
    static confirmModal(title, html, icon) {
        return new Promise((resolve, reject) => {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger me-3"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: title,
                html: html,
                icon: icon,
                showCancelButton: true,
                confirmButtonText: "Yes",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    resolve(true);
                } else {
                    resolve(false);
                }
            });
        });
    }

}
