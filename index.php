<?php
include 'header.php';
include 'processes/index.php';
?>

<div class="card mt-5 p-5">
    <div class="row justify-content-end">
        <div class="col-lg-2 col-sm-12">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGunModal" id="addNewGun">
                Add New Gun
            </button>

        </div>
    </div>

    <?php
    include 'view/modal/addnewgun.php';
    ?>

    <div class="table-responsive">
        <table class="table table-striped mt-3" id='gunsTable'>
            <thead class="table-secondary">
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Barrel</th>
                    <th scope="col">Magazine</th>
                    <th scope="col">Receiver</th>
                    <th scope="col">Sights</th>
                    <th scope="col">Accuracy</th>
                    <th scope="col">Capacity</th>
                    <th scope="col">Damage</th>
                    <th scope="col">Delete</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>

    </div>

</div>

<script>
    function deleteGun(id) {
        $.ajax({
            type: "POST",
            url: "processes/class.php",
            data: {
                action: "deleteGun",
                id: id
            },
            success: function(data) {
                refreshTable();
            }
        });

    }

    function refreshTable(){
        $.ajax({
            type: "POST",
            url: "processes/class.php",
            data: {
                    action: "refresh"
                },
            success: function(response) {
                $('#gunsTable').html(response);
            }
        });
    }

    function viewGun(id){
        $.ajax({
                type: "POST",
                url: "processes/class.php",
                data: 'action=getBuildGun&id=' + id,
                dataType: 'json',
                success: function(data) {
                    $('input[name="gunId"]').val(data.id);
                    $('#gunName').val(data.gunName);
                    $('#selectBarrel').val(data.barrel);
                    $('#selectReceiver').val(data.receiver);
                    $('#selectSights').val(data.sights);
                    $('#selectMagazine').val(data.magazine);
                    $("#accuracyTotal").html(data.accuracy);
                    $("#damageTotal").html(data.damage);
                    $("#capacityTotal").html(data.capacity);
                }
            });
    }
    $(function() {
        refreshTable();

        $('#addNewGun').click(function() {
            $.ajax({
                type: "POST",
                url: "processes/class.php",
                data: {
                    action: "getBase"
                },
                dataType: 'json',
                success: function(data) {
                    $("#accuracyTotal").html(data.accuracy);
                    $("#damageTotal").html(data.damage);
                    $("#capacityTotal").html(data.capacity);
                }
            });
        });


    });
</script>

<?php
include 'footer.php';
?>