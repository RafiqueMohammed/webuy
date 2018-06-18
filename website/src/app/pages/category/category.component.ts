import { Component, OnInit } from '@angular/core';
import { HelperService } from '../../providers/helper.service';
import { Router, ActivatedRoute } from '@angular/router';
import { APIService } from '../../providers/api.service';
import { ProductModel, ResponseModel } from '../../model/api-response';
import { Endpoints } from '../../config/endpoints';

@Component({
  selector: 'app-category',
  templateUrl: './category.component.html',
  styleUrls: ['./category.component.scss']
})
export class CategoryComponent implements OnInit {

  products: Array<ProductModel> = [];
  UILoaded: Boolean = false;
  constructor(private api: APIService, private helper: HelperService, private route: Router, private aRoute: ActivatedRoute) { }

  getImageURL(basename) {
    return this.api.getImageHost() + basename;
  }

  ngOnInit() {

    this.aRoute.params.subscribe(params => {
      this.helper.setPageName(params.category);
      this.api.getProductsBy(params.category).subscribe((res: ResponseModel) => {
        this.UILoaded = true;
        if (res.success === true) {
          this.products = res.data.map((v, k) => {
            v.url = `/${v.category_name}/${this.helper.getSlug(v.product_title)}/${v.product_id}`;
            return v;
          });

        }
      });
    });

  }

}
