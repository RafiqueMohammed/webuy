import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ServiceWorkerModule } from '@angular/service-worker';
import { environment } from '../environments/environment';
import { HttpClientModule } from '@angular/common/http';

/** APP MODULES AND COMPONENTS */
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';

/** PROVIDERS */
import { APIService } from './providers/api.service';
import { HelperService } from './providers/helper.service';
import { CartService } from './providers/cart.service';

@NgModule({
  declarations: [
    AppComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    BrowserAnimationsModule,
    AppRoutingModule,
    ServiceWorkerModule.register('/ngsw-worker.js', { enabled: environment.production })
  ],
  providers: [APIService, HelperService, CartService],
  bootstrap: [AppComponent]
})
export class AppModule { }
