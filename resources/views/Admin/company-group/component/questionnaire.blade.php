                 <!-- Modal Start -->

<div class="modal fade" id="newQuestionnaireModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body" id="questionnaire-form">
              <!-- questionair -->
              <div class="d-flex flex-column pb-4">
                        <h2 class="pb-2">Questionnaire </h2>
                      </div>
                      <div class="row "> 
                            <input type="hidden" name="questionnaire" value="1">
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                            <div class="input-wrapper">
                              <b>Questionnaire form</b>
                              <input type="text" id="questionair-input" name="form_name" placeholder="Form Description">
                            </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                            <div class="input-wrapper">
                              <b>Form Description</b>
                              <textarea class="Form Description" name="questionair_description" placeholder="Form Description"></textarea>
                            </div>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                              <div class="input-wrapper">
                                  <b>Question 1</b>
                                  <input type="text" name="questiona[]" id="questionair-input-1" placeholder="Question">
                              </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                              <div class="input-wrapper">
                                  <b>Answer Type</b>
                                  <select class="form-select answar-type" name="answer_type[]" aria-label="Default select example">
                                      <option value="">Answer Type</option>
                                      <option value="text">Single Text</option>
                                      <option value="radio">Single Choice</option>
                                      <option value="checkbox">Multiple Choice</option>
                                      <option value="select">Drop-Down</option>
                                      <option value="file">File Upload</option>
                                      <option value="date">Date</option>
                                  </select>
                              </div>
                          </div>
                          <div class="col-12 col-xl-12 mb-0 mb-xl-3" id="inputFields-1">
                                
                          </div>
                      </div>
                      <div id="movepage">
                        
                      </div>
                      <div>
                         <a class="btn btn-info" id="AddQuestion" style="float: right;position: relative;/* margin-bottom: -48px; */top: -19px; color: black">Question Add</a>
                      </div>
                 <!-- questionair end -->
                 <!-- submit questionnaire -->
                </div>
          <div class="modal-footer">        
            <button type="button" class="btn btn-primary" id="add-to-feed">Save</button>
          </div>
    </div>
  </div>
</div>

<!-- Modal End -->
<script type="text/javascript">
$(document).ready(function() {
    var country_id = 0;

    // Event delegation for adding questions
    $("body").on("click", "#AddQuestion", function(e) {
        $("#movepage").append(`
            <div class="row">
                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Question</b>
                        <button class="btn btn-danger remove-question" style="float: right; margin-bottom: 10px;">Remove</button>
                        <input type="text" name="questiona[]" id="questionair-input-${country_id}" placeholder="Question" />
                    </div>
                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3">
                    <div class="input-wrapper">
                        <b>Answer Type</b>
                        <select class="form-select answar-type" name="answer_type[]" aria-label="Default select example">
                                <option value="">Answer Type</option>
                                <option value="text">Single Text</option>
                                <option value="radio">Single Choice</option>
                                <option value="checkbox">Multiple Choice</option>
                                <option value="select">Drop-Down</option>
                                <option value="file">File Upload</option>
                                <option value="date">Date</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 col-xl-12 mb-0 mb-xl-3" id="inputFields-${country_id}">
                </div>
            </div>
        `);
        country_id++;
    });

    // Event delegation for removing questions
    $("body").on("click", ".remove-question", function (e) {
        $(this).closest(".row").remove();
        country_id--;
    });

    // Event delegation for handling answer type change
    $("body").on("change", ".answar-type", function () {
        showInputFields(this);
    });

    function showInputFields(selectElement) {
        const answerType = $(selectElement).val();
        const inputFields = $(selectElement).closest(".row").find(`[id^='inputFields-']`);
        inputFields.html(''); // Clear the input fields

        if (answerType === "text" || answerType === "file" || answerType === "date") {
            inputFields.html(`<div class="input-wrapper">
                <input type="hidden" name="option_name[${country_id}][]" value="${answerType}" class="option-name" placeholder="Label Name" />
            </div>`);
        } else if (answerType === "radio" || answerType === "checkbox" || answerType === "select") {
            inputFields.html(`<div class="input-wrapper " style=" position: relative;display: flex;">
                <b>Option Name</b>
                    <input type="text" name="option_name[${country_id}][]" class="option-name" placeholder="Option Name" />
                    <a class="btn btn-info add-option" style="height: 40px;margin-left: 10px; color: black">Add</a>
            </div>`);
        }
    }

    // Event delegation for adding options
    $("body").on("click", ".add-option", function () {
        const inputFields = $(this).closest(".row").find(`[id^='inputFields-']`);
        addOption(inputFields);
    });

    function addOption(inputFields) {
        const optionWrapper = document.createElement("div");
        optionWrapper.classList.add("input-wrapper");
        console.log(optionWrapper);
        optionWrapper.innerHTML = `
            <div class="input-wrapper " style=" position: relative; display: flex;">
                <b>Option Name</b>
                    <input type="text" name="option_name[${country_id}][]" class="option-name" placeholder="Option Name" />
                    <a class="btn btn-danger remove-option" style=" height: 39px; margin-left: 20px;color: #eeeeee">Remove</a>
            </div>`;
        inputFields.append(optionWrapper);
    }

    // Event delegation for removing options
    $("body").on("click", ".remove-option", function () {
        $(this).closest(".input-wrapper").remove();
    });

    $("body").on("click", "#add-to-feed", function () {
      let questionClone = $('body').find('div#questionnaire-form').clone();
      $('body').find('div#questionnaire-modal-add').html(questionClone);
      $('body').find('#newQuestionnaireModal').modal('hide');
    });
});
</script>