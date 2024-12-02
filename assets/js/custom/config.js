class configClass {
    constructor() {
        this.url = "";
        this.baseUrl = "";
    }

    setPageData() {
        window.url = new URL(window.location.href);
        window.baseUrl = window.url.origin + '/';
    }

    init() {
        this.setPageData();
    }
}

let initConfig = new configClass();
initConfig.init(); 
