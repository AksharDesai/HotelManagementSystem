<div class="container-fluid " id="main-content">
    <div class="row">
        <div class="col-lg-10 ms-auto p-4 flex-heading">


            <button type="button" class="btn btn-warning addroom-button" data-toggle="modal" data-target="#addroom">
                <i class="bi bi-house-gear-fill"></i> Add Room
            </button>

            <!-- Modal -->
            <div class="modal fade" id="addroom" tabindex="-1" role="dialog" aria-labelledby="addroomTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title bg-dark text-light p-2 w-100 text-center" id="addroomTitle">Fill Room Details</h5>

                        </div>
                        <div class="modal-body">

                            <form action="rooms.php" method="post" enctype="multipart/form-data">

                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="name" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Area</label>
                                        <input type="number" name="area" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Price</label>
                                        <input type="number" name="price" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Quantity</label>
                                        <input type="number" name="quantity" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Adult</label>
                                        <input type="number" name="adult" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Children</label>
                                        <input type="number" name="children" class="form-control shadow-none" required>
                                    </div>
                                    <div class="col-md-12 ps-0 mb-3">
                                        <label class="input-group-text">Picture</label>
                                        <input type="file" class="form-control" name="image" accept=".jpg,.png,.jpeg,.svg">
                                    </div>
                                    <div class="mb-3 col-12">

                                        <label class="form-label fw-bold">Features</label>


                                        <div class="row">
                                            <div class="col-md-3 mb-1">
                                                <label class="form-label">bathroom</label>
                                                <input type="checkbox" name="features[]" class="form-check-input shadow-none" value="bathroom">


                                            </div>
                                            <div class="col-md-3 mb-1">
                                                <label class="form-label">bedroom</label>
                                                <input type="checkbox" name="features[]" class="form-check-input shadow-none" value="bedroom">


                                            </div>
                                            <div class="col-md-3 mb-1">
                                                <label class="form-label">balcony</label>
                                                <input type="checkbox" name="features[]" class="form-check-input shadow-none" value="balcony">


                                            </div>



                                        </div>
                                    </div>
                                    <div class="mb-3 col-12">

                                        <label class="form-label fw-bold">Facilities</label>
                                        <div class="row">
                                            <div class="col-md-3 mb-1">
                                                <label>Wifi</label>
                                                <input type="checkbox" name="facilities[]" value="wifi" class="form-check-input shadow-none">


                                            </div>
                                            <div class="col-md-3">
                                                <label>AC</label>
                                                <input type="checkbox" name="facilities[]" value="ac" class="form-check-input shadow-none">


                                            </div>
                                            <div class="col-md-3">
                                                <label> Room Heater</label>
                                                <input type="checkbox" name="facilities[]" value="room heater" class="form-check-input shadow-none">


                                            </div>
                                            <div class="col-md-3">
                                                <label>Television</label>
                                                <input type="checkbox" name="facilities[]" value="television" class="form-check-input shadow-none">


                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <label>Spa</label>
                                                <input type="checkbox" name="facilities[]" value="spa" class="form-check-input shadow-none">


                                            </div>
                                            <div class="col-12 ">
                                                <label class="form-label fw-bold">Description</label>
                                                <textarea name="desc" rows="4" class="form-control"></textarea>
                                            </div>


                                            <div class="col-md-12 ps-0 mt-3 mb-3">
                                                <label class="input-group-text">Video</label>
                                                <input type="file" class="form-control" name="video" >
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-dark text-light" data-dismiss="modal">Close</button>

                                    <button type="submit" class="btn btn-success my-1" name="addroom">Add Room</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>