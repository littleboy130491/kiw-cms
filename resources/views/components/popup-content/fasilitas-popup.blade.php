<!--Popup Content-->
<div id="modal" class="fixed inset-0 flex items-center justify-center z-[999] hidden">
    <!-- Overlay -->
    <div class="modal-overlay absolute inset-0 bg-black opacity-75 z-50"></div>

    <!-- Modal Container -->
    <div
        class="popup-facility modal-container bg-white w-[90%] mt-[50px] lg:h-[80%] sm:h-[700px] h-[600px] sm:w-[85%] lg:w-[75%] mx-auto rounded-lg shadow-lg z-50 overflow-auto !-mt-11">
        <!-- Modal Header -->
        <div class="modal-header flex flex-row justify-end pr-2 pt-2">
            <button class="modal-close cursor-pointer" onclick="closeModal()">
                <svg class="fill-current text-black h-6 w-6" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                </svg>
            </button>
        </div>

        <!-- Modal Content -->
        <div class="modal-content pb-3 px-3 sm:pb-6 sm:px-6">
            <div class="flex lg:flex-row flex-col gap-6">
                <!-- Gambar -->
                <div class="modal-image w-full">
                    <img class="!w-full h-full object-center object-cover rounded-md" src=""
                        alt="Foto Manajemen">
                </div>

                <div class="modal-info w-full flex flex-col items-start lg:gap-4 gap-3 overflow-hidden">
                    <h4 class="modal-title flex flex-row justify-start w-full"></h4>

                    <div
                        class="modal-description text-[var(--color-text)] w-full lg:h-[500px] h-full !overflow-auto pb-6 lg:pb-0">

                    </div>
                </div>


            </div>
        </div>
    </div>
</div>