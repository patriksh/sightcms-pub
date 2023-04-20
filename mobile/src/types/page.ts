export type Page = {
    _id: string,
    slug: string,
    title: string,
    content: string
}

export type PagesResponse = {
    pages: Page[]
}

export type PageResponse = {
    page: Page
}