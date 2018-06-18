import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Endpoints } from '../config/endpoints';

@Injectable()
export class APIService {

  HOST: any = 'http://localhost:8888';
  constructor(private http: HttpClient) {
  }
  setHost(_host) {
    this.HOST = 'http://' + _host;
    console.log('setHost', _host);
  }
  getImageHost() {
    return this.HOST + '/webuy/webservice/uploads/';
  }
  public getDashboard() {
    return this.http.get(Endpoints.getURL(this.HOST, Endpoints.DASHBOARD, {}));
  }

  public getProduct(id: String) {
    return this.http.get(Endpoints.getURL(this.HOST, Endpoints.PRODUCT, { id: id }));
  }
  public getProductsBy(category: String) {
    return this.http.get(Endpoints.getURL(this.HOST, Endpoints.CAT_PRODUCT, { category: category }));
  }
  public getCategories() {
    return this.http.get(Endpoints.getURL(this.HOST, Endpoints.CATEGORIES, {}));
  }
  public placeOrder(data) {
    return this.http.post(Endpoints.getURL(this.HOST, Endpoints.PLACE_ORDER, {}), data);
  }

}
