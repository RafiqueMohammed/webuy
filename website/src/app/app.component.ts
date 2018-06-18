import { Component, OnInit } from '@angular/core';
import { APIService } from './providers/api.service';
import { CategoryModel, ResponseModel } from './model/api-response';
import { HelperService } from './providers/helper.service';
import { CartService } from './providers/cart.service';
import { ActivatedRoute } from '@angular/router';

declare var $: any;
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})

export class AppComponent implements OnInit {
  pageName: String = '';
  categories: Array<CategoryModel> = [];
  cartCount: Number = 0;
  constructor(private api: APIService, private helper: HelperService, private cart: CartService, private aRoute: ActivatedRoute) {
    this.helper.PageNameListener.subscribe((name: String) => { this.pageName = name; });

    // for testing purpose, when deployed to firebase
    this.aRoute.queryParams.subscribe(params => {
      if (params.baseurl) {
        localStorage.setItem('BASE_URL', params.baseurl);
        this.api.setHost(params.baseurl);
      } else {
        if (localStorage.getItem('BASE_URL') && localStorage.getItem('BASE_URL') !== '') {
          this.api.setHost(localStorage.getItem('BASE_URL'));
        }
      }

      this.api.getCategories().subscribe((result: ResponseModel) => {
        if (result.success === true) {
          this.categories = result.data;
        }
      });
    });
  }



  ngOnInit() {

    this.cart.listener.subscribe(cart => {

      this.cartCount = cart.length;
    });



    $(document).ready(function () { $('body').bootstrapMaterialDesign(); });
  }
}
