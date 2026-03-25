export type User = {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    roles: Role[];
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};

export interface RolePivot {
  model_type: string
  model_id: number
  role_id: number
}

export interface Role {
  id: number
  name: string
  guard_name: string
  created_at: string
  updated_at: string
  pivot?: RolePivot
}
