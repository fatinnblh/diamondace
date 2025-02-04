@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-5">Do you have question?</h1>

    <div class="accordion" id="faqAccordion">
        <!-- Question 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    Do you accept Microsoft Word files?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    All files should be sent to us as press-ready PDF files. If you are unable to send files in this format then a word file for your thesis can be sent. We will convert this file into a PDF file and send it back to you for checking. If you are happy then we can proceed to print.
                </div>
            </div>
        </div>

        <!-- Question 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    What happens if I lose my files?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    If you lose your files please send us an email. We keep all files on our system indefinitely unless we have been instructed to delete them. We are more than happy to send any files to you.
                </div>
            </div>
        </div>

        <!-- Question 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    Can graphics be included in my book?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Absolutely, we can print any text, images, graphics and illustrations etc. Please make sure any text has it’s fonts embedded.
                </div>
            </div>
        </div>

        <!-- Question 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                    Does it cost extra for graphics / illustrations?
                </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    There is no extra cost for any images, graphics and illustrations etc. The only thing to remember is if your page has any amount of colour on then you will need to count this as a printed colour page.
                </div>
            </div>
        </div>

        <!-- Question 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                    How do I place an order?
                </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Orders can be placed on our website via our order form. If you are unsure of what specifications you would like for your book, please contact us.
                </div>
            </div>
        </div>

        <!-- Question 6 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading6">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                    When do I pay?
                </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                Payment is needed before you submit the details of your thesis by qr code or by cash at our store before we print the main run of your thesis. You need to send a proof copy if you pay by qr code. We will proceed the printing after the payment accepted.
                </div>
            </div>
        </div>

        <!-- Question 7 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="heading7">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                    How do I re-order?
                </button>
            </h2>
            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                If you need to re-order any copies of your book you can fill out a new order at our website. If there are no changes to the text file or cover file then there is no need to send in new files. If there are any changes then please send in the new files to us. There is no extra charge for new files.
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-button:not(.collapsed) {
        background-color: #0A2472;
        color: white;
    }
    
    .accordion-button:focus {
        border-color: #0A2472;
        box-shadow: 0 0 0 0.25rem rgba(10, 36, 114, 0.25);
    }

    .accordion-button::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%230A2472'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }

    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    }
</style>
@endsection
