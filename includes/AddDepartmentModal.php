<div class="modal fade" id="AddDepartment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Department</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="create-department-form">
                    <input type="hidden" name="actionType" id="actionType" class="form-control" value="CreateDepartment">
                    <div class="mb-3">
                        <label for="department_name">Name</label>
                        <input type="text" name="department_name" id="department_name" class="form-control" placeholder="Enter Department Name">
                    </div>
                    <div class="mb-3">
                        <label for="department_code">Code</label>
                        <input type="text" name="department_code" id="department_code" class="form-control" placeholder="Enter Department Code">
                    </div>
                    <div class="mb-3">
                        <label for="department_description">Description</label>
                        <textarea type="text" name="department_description" id="department_description" class="form-control" placeholder="Enter Department Name"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>