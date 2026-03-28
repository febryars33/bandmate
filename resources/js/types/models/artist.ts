import type { Discography } from "./discography";
import type { Genre } from "./genre";
import type { ArtistMusician } from "./pivots/artist_musician";
import type { Recruitment } from "./recruitment";
import type { Regency } from "./regency";

export type Artist = {
    id: number;
    regency_id: number | null;
    regency_name: string | null;
    spotify_artist_id: string | null;
    name: string;
    slug: string;
    about: string;
    truncated_about: string;
    is_verified: boolean;
    spotify_synced_at: string;
    img_logo: string | null;
    img_cover: string | null;
    regency?: Regency | null;
    few_genres: Genre[];
    genres: Genre[];
    recruitments: Recruitment[]
    discographies: Discography[];
    discographies_count?: number;
    complete_lineups: ArtistMusician[];
    current_lineups: ArtistMusician[];
    past_members: ArtistMusician[];
};
