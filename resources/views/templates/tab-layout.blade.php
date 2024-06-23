<div class="col-sm-12 col-lg-6 d-flex justify-content-end">
    <ul class="nav nav-tabs gap-2 px-4 py-3 d-flex align-items-center justify-content-center rounded-2" id="myTab"
        role="tablist" style="background: #C4DFFF">
        <li class="nav-item">
            <a class="nav-link tab" id="reksa-tab" data-bs-toggle="tab" href="#reksa" role="tab" aria-controls="reksa"
                aria-selected="false">
                <img src="/assets/images/icons/reksa.svg" alt="Reksa icon" class="mb-2">
                <p class="paragraph fw-bold">
                    REKSA
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab" id="bacain-tab" data-bs-toggle="tab" href="#bacain" role="tab"
                aria-controls="bacain" aria-selected="false">
                <img src="/assets/images/icons/bacain.svg" alt="Bacain icon">

                <p class="paragraph fw-bold">
                    BACAIN
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab" id="sikat-tab" data-bs-toggle="tab" href="#sikat" role="tab"
                aria-controls="sikat" aria-selected="false">
                <img src="/assets/images/icons/sikat.svg" alt="Sikat icon">
                <p class="paragraph fw-bold">
                    SIKAT
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link tab" id="verif-tab" data-bs-toggle="tab" href="#verif" role="tab"
                aria-controls="verif" aria-selected="false">
                <img src="/assets/images/icons/verif.svg" alt="Verif icon">
                <p class="paragraph fw-bold">
                    VERIF
                </p>
            </a>
        </li>
    </ul>
</div>

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function getQueryParams() {
                const params = {};
                const queryString = window.location.search.substring(1);
                const regex = /([^&=]+)=([^&]*)/g;
                let m;
                while (m = regex.exec(queryString)) {
                    params[decodeURIComponent(m[1])] = decodeURIComponent(m[2]);
                }
                return params;
            }

            function activateTabFromParamsOrHash() {
                const params = getQueryParams();
                const hash = window.location.hash;
                let tabLink;

                // Check if username parameter exists
                if (params.userId) {
                    tabLink = document.querySelector(`a[href="#reksa"]`);
                } else if (hash) {
                    tabLink = document.querySelector(`a[href="${hash}"]`);
                }

                // If the tab link exists, trigger a click event on it to make it active
                if (tabLink) {
                    var tab = new bootstrap.Tab(tabLink);
                    tab.show();
                }
            }

            // Activate tab based on URL parameters or fragment
            activateTabFromParamsOrHash();

            // Listen for hash change events
            window.addEventListener('hashchange', activateTabFromParamsOrHash);
        });
    </script>
@endpush
