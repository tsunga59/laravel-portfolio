## Acmo

**「ActiveなMorning(朝活)を通して、1日をもっと有意義に過ごそう」**というコンセプトをもとに開発した**朝活SNSサービス**

URL: https://acmo-app.com

## サービス概要

#### 基本的な機能・使い方

投稿・タグづけ・コメント・プロフィール・フォロー・いいね等の基本的なSNS機能の他、

朝活目標時間の設定・朝活達成日数(率)の表示・朝活達成ランキング・朝活ランクシステム(今後実装予定)等、朝活に特化した機能を実装しています。

特に下記のような特徴を持ったサービスです。

* 朝活仲間と投稿を共有したり、いいねやコメント等のリアクションを通して交流ができる
* 設定した朝活目標時間より前に投稿すると、朝活達成日数がカウントされる
* 朝活達成日数が多いユーザーはランキング表示される
* 朝活達成率に応じて各ユーザーにランクバッジが表示される(今後実装予定)


#### ターゲット(問題)

* 朝活をしたいけどモチベーションが続かない
* 朝活の継続方法を調べてはみるけど実践できない
* 1日のスタートが遅れてダラダラしてしまう

自分以外に周りの友人にも同じような悩みを抱えている人は結構多い印象です。

#### メリット(解決策)

* 朝活内容の共有や仲間との交流によって、モチベーションの低下を防ぐ
* その日のタスクを朝にこなすことで、余裕を持って1日を過ごせる
* 朝の時間を使って新しいことにチャレンジできる

## 使用技術・ツール

#### フロントエンド

* HTML/CSS
* Sass
* JavaScript
* Vue.js

#### バックエンド

* PHP: 7.4.2
* Laravel: 8.45.1

#### インフラ

* Docker: 20.10.6
* Docker-compose: 1.29.1
* Nginx: 1.21.0
* MySQL: 5.7.34
* AWS(IAM, VPC, EC2, RDS, Route53, ACM, ELB, S3, CloudWatch,etc.)

#### その他ツール

* Git/Github(ソースコード・バージョン管理)
* Figma(ワイヤー作成)
* draw.io(ER図・インフラ構成図作成)
* Notion(タスク管理・開発メモ)

## ワイヤーフレーム

[Figma](https://www.figma.com/file/PlVDANTbGP1jRUfpvCG3Df/%E3%83%9D%E3%83%BC%E3%83%88%E3%83%95%E3%82%A9%E3%83%AA%E3%82%AA?node-id=0%3A1)

![wireframe](https://raw.githubusercontent.com/wiki/tsunga59/laravel-portfolio/wireframe.png)

## URL設計

[Googleスプレッドシート](https://docs.google.com/spreadsheets/d/1-HKQVHc2H1sRljCJYMSkFLuDaZWvzj4S2SETDevr0pw/edit?usp=sharing)

![url_structure](https://raw.githubusercontent.com/wiki/tsunga59/laravel-portfolio/url_structure.png)

## テーブル設計(ER図)

![table_structure](https://raw.githubusercontent.com/wiki/tsunga59/laravel-portfolio/table_structure.png)

## インフラ設計(構成図)

![aws_structure](https://raw.githubusercontent.com/wiki/tsunga59/laravel-portfolio/aws_structure.png)

## 実装機能

#### ユーザー登録・ログイン機能

* メールアドレス・パスワードを用いたユーザー登録・ログインが可能

#### ソーシャル(Google)ログイン機能

* Googleアカウントを用いたユーザー登録・ログインが可能

#### ゲストログイン機能

* 情報を入力せずサービスを一通り操作可能(ユーザー名・プロフィール画像は変更不可)

#### 投稿(CRUD)機能

* 投稿の新規作成・詳細確認・編集・削除が可能

#### タグ付け機能

* 投稿に関連したタグを追加＆タグごとの投稿一覧表示が可能

#### いいね機能

* 投稿にいいね追加・削除&いいねした投稿一覧表示が可能

#### コメント機能

* 投稿にコメントを追加・削除が可能

#### プロフィール編集機能

* ユーザー名・プロフィール画像・自己紹介・朝活目標時間の設定&投稿・いいねした投稿・フォロー・フォロワー一覧表示が可能

#### 画像アップロード機能

* S3への画像アップロード&画像編集時のプレビューが可能

#### フォロー機能

* 他ユーザーへのフォロー追加・削除が可能

#### 朝活達成判定(ポップアップ表示)機能

* 朝活目標時間より早く投稿した際に、朝活達成日数をカウントしたポップアップが表示される

#### 朝活達成ランキング機能

* 朝活達成日数に応じて、上位ユーザー(TOP5)はランキングに表示される

#### レスポンシブ対応

* PC・SPそれぞれに対応したデザイン・レイアウトを実装

## 工夫・苦労した点

#### Dockerを用いた開発環境構築

* 開発/本番環境での差異を減らす・環境構築作業の効率化等のメリットを考慮して採用。
特にDockerfile内のパッケージインストールでエラーが度々発生し苦戦した。

#### AWSを用いたインフラ構築・デプロイ

* 自分で一通りインフラを構築し、インフラ周りの知識を身につけるために採用。
基礎学習〜デプロイまでの過程で、基本的なAWSサービスの使い方や構成に加え、ネットワークやセキュリティ周りの知識も体系的に学ぶことができた。

#### gitを用いた擬似チーム開発

* 機能ごとにfeatureブランチを切って実装・masterブランチへプルリクといった流れで、実際のチーム開発を意識して開発を進めた。

## 今後の課題

開発を進める中で新たな課題が見つかり、特に下記の体系的な学習が必要だと痛感した。

* コンピュータ基礎
* ネットワーク基礎
* SQL基礎
