<div class="modal fade" id="addpromocode">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <form method="POST" action="{{ route('promocode.store') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Modal body -->
                <div class="modal-body">
                    <label for="name">Code</label>
                    <input type="Text" class="form-control mt-2" id="name" Name="name"
                        placeholder="Enter code here .." required>

                    <div class="form-check mt-4">
                        <label for="type">Type</label>
                        <select class="form-control mt-2" id="type" name="type">
                            <option value="percentage">Percentage</option>
                            <option value="amount">Amount</option>
                        </select>
                    </div>

                    <div class="form-check mt-4" id="percentage-field" style="display: none;">
                        <label for="percentage">Percentage (%)</label>
                        <input type="number" class="form-control mt-2" id="percentage" name="percentage"
                            placeholder="Enter percentage here" min="1" max="100">
                    </div>

                    <div class="form-check mt-4" id="amount-field" style="display: none;">
                        <label for="amount">Amount (EGP)</label>
                        <input type="number" class="form-control mt-2" id="amount" name="amount"
                            placeholder="Enter amount here" min="1">
                    </div>

                    <div class="form-check mt-4">
                        <label for="start_date">Start Date</label>
                        <input type="date" class="form-control" name="start_date" required>
                    </div>

                    <div class="form-check mt-2">
                        <label for="end_date">End Date</label>
                        <input type="date" class="form-control" name="end_date" required>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" name="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('type').addEventListener('change', function () {
        var type = this.value;
        var percentageField = document.getElementById('percentage-field');
        var amountField = document.getElementById('amount-field');

        if (type === 'percentage') {
            percentageField.style.display = 'block';
            amountField.style.display = 'none';
        } else if (type === 'amount') {
            percentageField.style.display = 'none';
            amountField.style.display = 'block';
        }
    });

    // Initialize the field visibility when the page loads
    document.addEventListener('DOMContentLoaded', function () {
        var type = document.getElementById('type').value;
        var percentageField = document.getElementById('percentage-field');
        var amountField = document.getElementById('amount-field');

        if (type === 'percentage') {
            percentageField.style.display = 'block';
            amountField.style.display = 'none';
        } else if (type === 'amount') {
            percentageField.style.display = 'none';
            amountField.style.display = 'block';
        }
    });
</script>
