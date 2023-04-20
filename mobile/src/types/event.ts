export type Event = {
    _id: string,
    slug: string,
    title: string,
    location: string,
    date_from: string, // TODO: Convert to date on API
    date_to: string, // TODO: Convert to date on API
    image: string,
    image_url: string,
    logo_url: string,
    website_link: string,
    content?: string,
    url?: string
}

export type EventsResponse = {
    events: {
        data: Event[],
        current_page: number,
        last_page: number,
        per_page: number,
        total: number
    }
}

export type EventResponse = {
    event: Event
}