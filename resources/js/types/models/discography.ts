export type Discography = {
    id: number;
    artist_id: number;
    title: string;
    release_date: string;
    labels: string[];
    cover: string | null;
    slug: string;
};
