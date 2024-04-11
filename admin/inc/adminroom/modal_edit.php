<div class="modal fade" id="editroom" tabindex="-1" role="dialog" aria-labelledby="addroomTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bg-dark text-light p-2 w-100 text-center" id="addroomTitle">Edit Room Details</h5>

            </div>
            <div class="modal-body">

                <form action="rooms.php" method="POST" enctype="multipart/form-data">

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" name="name" id="editname" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Area</label>
                            <input type="number" name="area" id="editarea" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Price</label>
                            <input type="number" name="price" id="editprice" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Quantity</label>
                            <input type="number" name="quantity" id="editquantity" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Adult</label>
                            <input type="number" name="adult" id="editadult" class="form-control shadow-none" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Children</label>
                            <input type="number" name="children" id="editchildren" class="form-control shadow-none" required>
                        </div>
                        <img src=" " id="editimg" alt="" width="200px" height="200px" class="mb-3 apna"> <br>
                        <div class="col-md-12 ps-0 mb-3">
                            <label class="input-group-text">Picture</label>
                            <input type="file" class="form-control" name="image" id="editimage" accept=".jpg,.png,.jpeg,.svg">
                        </div>
                        <input type="hidden" name="editrid" id="editrid">
                        <div class="mb-3 col-12">


                            <label class="form-label fw-bold">Features</label>


                            <div class="row">
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">bathroom</label>
                                    <input type="checkbox" name="features[]" id="editfeatures[]" class="form-check-input shadow-none" value="bathroom">


                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">bedroom</label>
                                    <input type="checkbox" name="features[]" id="editfeatures[]" class="form-check-input shadow-none" value="bedroom">


                                </div>
                                <div class="col-md-3 mb-1">
                                    <label class="form-label">balcony</label>
                                    <input type="checkbox" name="features[]" id="editfeatures[]" class="form-check-input shadow-none" value="balcony">


                                </div>



                            </div>
                        </div>
                        <div class="mb-3 col-12">

                            <label class="form-label fw-bold">Facilities</label>
                            <div class="row">
                                <div class="col-md-3 mb-1">
                                    <label>Wifi</label>
                                    <input type="checkbox" name="facilities[]" id="editfacilities[]" value="wifi" class="form-check-input shadow-none">


                                </div>
                                <div class="col-md-3">
                                    <label>AC</label>
                                    <input type="checkbox" name="facilities[]" id="editfacilities[]" value="ac" class="form-check-input shadow-none">


                                </div>
                                <div class="col-md-3">
                                    <label> Room Heater</label>
                                    <input type="checkbox" name="facilities[]" id="editfacilities[]" value="room heater" class="form-check-input shadow-none">


                                </div>
                                <div class="col-md-3">
                                    <label>Television</label>
                                    <input type="checkbox" name="facilities[]" id="editfacilities[]" value="television" class="form-check-input shadow-none">


                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>Spa</label>
                                    <input type="checkbox" name="facilities[]" id="editfacilities[]" value="spa" class="form-check-input shadow-none">


                                </div>
                                <div class="col-12 ">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="desc" id="editdesc" rows="4" class="form-control"></textarea>
                                </div>

                                <div class="col-12 mt-2">
                                    <label class="form-label fw-bold mt-2">Room Status</label>
                                    <select class="form-select" aria-label="Filter by status" name="room_status">
                                        <option value="1" selected>Available</option>
                                        <option value="2">All Booked !</option>
                                        <option value="3">Under Maintenance </option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark text-light" data-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-success my-1" name="editroom">Save Changes</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>