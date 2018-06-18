import { Injectable } from '@angular/core';
import { BehaviorSubject } from 'rxjs/BehaviorSubject';
import { ProductModel } from '../model/api-response';

@Injectable()
export class CartService {
  _cart = [];
  listener = new BehaviorSubject([]);
  constructor() {
    if (localStorage.getItem('CART_LIST') == null || localStorage.getItem('CART_LIST') === '') {
      console.log('Cart initialized.');
      this.clear();
    } else {
      console.log('Cart restored.');
      this._cart = JSON.parse(localStorage.getItem('CART_LIST'));
      this.listener.next(this._cart);
    }
  }
  get() {
    return this._cart;
  }
  add(product: ProductModel) {
    this._cart.push(product);
    localStorage.setItem('CART_LIST', JSON.stringify(this._cart));
    this.listener.next(this._cart);
  }
  clear() {
    this._cart = [];
    localStorage.setItem('CART_LIST', JSON.stringify([]));
    this.listener.next([]);
  }
  remove(product: ProductModel) {
    this._cart.forEach((v, k) => {
      if (v.product_id === product.product_id) {
        this._cart.splice(k, 1);
        localStorage.setItem('CART_LIST', JSON.stringify(this._cart));

        this.listener.next(this._cart);
      }
    });
  }

}
