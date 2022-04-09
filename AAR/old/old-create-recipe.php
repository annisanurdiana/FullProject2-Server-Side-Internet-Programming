<form>
    <div class="modal fade" id="addDish" data-keyboard="false">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title upload-title">Create your own recipe</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-1"></div>
                            <div class="col-2">
                                <label for="dish-name" class="label-post">Recipe name</label>
                            </div>
                            <div class="col-9">
                                <input type="text" name="dish-name" id="dish-name" placeholder="Recipe name"
                                    class="form-control" required>
                            </div>

                            <div class="col-1"></div>
                            <div class="col-11 pt-3">
                                <input type="file" name="recipe-photo" id="recipe-photo" accept=".png,.jpg,.jpeg,.gif">
                                <label for="recipe-photo" id="recipe-photo-click"><span style="color: yellow; font-size: 20px;">+</span> Add photo</label>
                            </div>

                            <div class="col-1"></div>
                            <div class="col-11">
                                Preview: <b id="preview-text">-</b>
                                <br>
                                <div id="previewCon">
                                    <img id="img-preview" style="width: 150px; height: 100px">
                                </div>
                            </div>
    
                            <div class="col-1"></div>
                            <div class="col-11 mt-3">
                                <textarea name="dish-desc" id="dish-desc" class="form-control w-100" rows="3"
                                    placeholder="Describe this dish..." required></textarea>
                            </div>
    
                            <div class="col-12">
                                <hr>
                            </div>
    
                            <div class="col-1 mt-3"></div>
                            <div class="col-11">
                                <label for="ingredient-post" class="label-post">Ingredients</label>
                            </div>
    
                            <div class="col-1"></div>
                            <div class="col-11">
                                <textarea name="ingredient-post" id="ingredient-post" class="form-control w-100" rows="5"
                                    placeholder="- 1 Apple" required></textarea>
                            </div>
    
    
                            <div class="col-1 mt-3"></div>
                            <div class="col-11">
                                <label for="instruction-post" class="label-post">Instructions</label>
                            </div>
    
                            <div class="col-1"></div>
                            <div class="col-11">
                                <textarea name="instruction-post" id="instruction-post" class="form-control w-100" rows="5"
                                    placeholder="1. Peel the apples" required></textarea>
                            </div>
    
                        </div>
                    </div>
    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="create-dish" type="submit" class="btn btn-success" name="create-dish">Create</button>
                </div>
            </div>
        </div>
    </div>
<!-- </form> -->
<div class="col-2"></div>