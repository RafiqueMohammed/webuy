
export interface StoryModel {
    _id: String;
    title: String;
    shortBody: String;
    authorName: String;
    body: String;
    celebritytags: Array<String>;
    mainSection: any;
    next?: any;
    nextArticles?: any;
    publishedAt: String;
    related: Array<any>;
    slug: String;
    tags: any;
    thumbnail: String;
    type: String;
    views: Number;
    youtubeID?: any;
    media: Array<any>;
    publishedAt_gmt: String;
    questions?: any;
    trending: any;
    shareURL: String;
    lang?: String; // for url on click
}




export interface ShortStoryModel {
    _id: String;
    title: String;
    shortBody: String;
    authorName: String;
    mainSection: {
        color?: String;
        parentSection: String
        parentSlug: String
        slug: String
        title: String
        _id: String
    };
    publishedAt: String;
    thumbnail: String;
    type: String;
    views: Number;
    shareURL: String;
    lang: String; // for url on click

    celebritytags?: String;
    exclusive?: Boolean;
    likesCount?: Number;
    slug?: String;
    small?: String;
}



