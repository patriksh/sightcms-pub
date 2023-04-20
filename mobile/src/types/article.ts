import { Category } from './category';

export type ArticleCategory = Category;

export type Article = {
    _id: string,
    slug: string,
    title: string,
    summary: string,
    image_url: string|null,
    content?: string,
    url?: string,
    article_category_id: number|null,
    article_category: ArticleCategory|null,
    published_at: string,
    updated_at: string
}

export type ArticlesResponse = {
    articles: {
        data: Article[],
        current_page: number,
        last_page: number,
        per_page: number,
        total: number
    }
}

export type ArticleCategoriesResponse = {
    categories: ArticleCategory[]
}

export type ArticleResponse = {
    article: Article
}