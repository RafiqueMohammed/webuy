export class Endpoints {


    private static HOST = '/webuy/webservice/public/web';
    public static DASHBOARD = Endpoints.HOST + '/products';
    public static PRODUCT = Endpoints.HOST + `/products/:id`;
    public static CATEGORIES = Endpoints.HOST + `/categories`;
    public static CAT_PRODUCT = Endpoints.HOST + `/categories/:category`;
    public static PLACE_ORDER = Endpoints.HOST + `/orders`;

    public static getURL(host: any, url: any, params: any) {
        Object.keys(params).forEach(function (v, i) {
            url = url.replace(':' + v, params[v]);
        });
        return host + url;

    }

}
